import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, LoadingController, ToastController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";

import {ShowSlaveDetailPage} from "../show-slave-detail/show-slave-detail";
import {SlavePreseedPage} from "../slave-preseed/slave-preseed";
import {SlaveHypervisorSelectionPage} from "../slave-hypervisor-selection/slave-hypervisor-selection";

/**
 * Generated class for the ShowMasterDetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-show-master-detail',
    templateUrl: 'show-master-detail.html',
})
export class ShowMasterDetailPage {

    public userPostData = {
        'token_id': '',
        'user_id': '',
        'master_id': '',
    };

    public vm_detail: any;
    public vm_slaves: any;

    constructor(public navCtrl: NavController, public navParams: NavParams, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController, private toastCtrl: ToastController) {
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.master_id = localStorage.getItem('vmID');
        this.loadMasterDetails();
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad ShowMasterDetailPage');
    }

    loadMasterDetails() {
        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        loading.present();

        let logRes = this.authServiceProvider.postData(this.userPostData, 'master_server_details');

        if (logRes['error'] === false) {
            (logRes['results'] == null) ? this.vm_detail = this.generateDefaultMasterDetail() : this.vm_detail = logRes['results'];

            loading.dismiss();
            this.loadMasterSlaves();
        } else {
            let toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });

            loading.dismiss();
            toast.present();
        }
    }

    loadMasterSlaves() {
        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        loading.present();

        let logRes = this.authServiceProvider.postData(this.userPostData, 'slave_server_list');

        if (logRes['error'] === false) {
            this.vm_slaves = logRes['results']['list'];

            loading.dismiss();
        } else {
            let toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });

            loading.dismiss();
            toast.present();
        }
    }

    showSlaveDetail(slaveID) {
        this.navCtrl.push(ShowSlaveDetailPage, {'slaveID': slaveID});
    }

    createSalveForMaster() {
        this.navCtrl.push(SlaveHypervisorSelectionPage, {'slaveID': this.userPostData.master_id});
    }

    showSlavePreseed(slaveID, distributionID) {
        console.log(slaveID);
        console.log(distributionID);
        this.navCtrl.push(SlavePreseedPage, {'slaveID': slaveID, 'distributionID': distributionID});
    }

    private generateDefaultMasterDetail() {
        return {
            'name': 'VM NAME',
            'ip': 'VM IP',
            'mac': 'VM MAC',
            'gateway': 'VM GATEWAY',
            'memory': 'VM MEMORY',
            'storage': 'VM STORAGE'
        };
    }
}
