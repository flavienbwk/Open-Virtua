import {Component} from '@angular/core';
import {IonicPage, NavController, LoadingController, ToastController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";

import {AddMasterServerPage} from "../add-master-server/add-master-server";
import {UpdateMasterPage} from "../update-master/update-master";

import {ShowMasterDetailPage} from "../show-master-detail/show-master-detail";

/**
 * Generated class for the DashboardPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-dashboard',
    templateUrl: 'dashboard.html',
})
export class DashboardPage {

    public userPostData = {'token_id': '', 'user_id': ''};
    public userTokenExpire: any;

    public vms: any;

    constructor(public navCtrl: NavController, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController, private toastCtrl: ToastController) {
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userTokenExpire = localStorage.getItem('token_expiration');

        this.loadVms();
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad DashboardPage');
    }

    loadVms() {
        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        loading.present();

        let logRes = this.authServiceProvider.postData(this.userPostData, 'master_server_list');

        if (logRes['error'] === false) {
            this.vms = logRes['results']['list'];

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

    updateMaster(vmID) {
        this.navCtrl.push(UpdateMasterPage, {'vmID': vmID});
    }

    showMasterDetail(vmID) {
        localStorage.setItem('vmID', vmID);
        this.navCtrl.push(ShowMasterDetailPage);
    }

    createMasterServer() {
        this.navCtrl.push(AddMasterServerPage);
    }
}
