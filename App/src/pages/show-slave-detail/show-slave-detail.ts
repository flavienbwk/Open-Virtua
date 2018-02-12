import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, LoadingController, ToastController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";

/**
 * Generated class for the ShowSlaveDetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-show-slave-detail',
    templateUrl: 'show-slave-detail.html',
})
export class ShowSlaveDetailPage {

    public userPostData = {
        'token_id': '',
        'user_id': '',
        'master_id': '',
        'slave_id':''
    };

    public slave_detail: any;

    constructor(public navCtrl: NavController, public navParams: NavParams, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController, private toastCtrl: ToastController) {
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.master_id = localStorage.getItem('vmID');
        this.userPostData.slave_id = this.navParams.get('slaveID');
        this.loadSlaveDetail();
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad ShowSlaveDetailPage');
    }

    loadSlaveDetail () {
        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        loading.present();

        let logRes = this.authServiceProvider.postData(this.userPostData, 'slave_server_details');

        if (logRes['error'] === false) {
            this.slave_detail = logRes['results'];

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

    removeSlave(hypervisorID) {
        let postData = {
            'token_id': this.userPostData.token_id,
            'user_id': this.userPostData.user_id,
            'master_id': this.userPostData.master_id,
            'hypervisor_id': hypervisorID,
            'slave_id': this.userPostData.slave_id
        };

        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        loading.present();

        let logRes = this.authServiceProvider.postData(postData, 'slave_server_remove');

        if (logRes['error'] === false) {
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

}
