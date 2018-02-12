import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, LoadingController, ToastController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";
import {DashboardPage} from "../dashboard/dashboard";

/**
 * Generated class for the UpdateMasterPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-update-master',
    templateUrl: 'update-master.html',
})
export class UpdateMasterPage {

    public userPostData = {
        'token_id': '',
        'user_id': '',
        'master_id': '',
        'remove': null,
        'ssh_port': '',
        'username': '',
        'password': '',
        'memory': '',
        'storage': ''
    };

    constructor(public navCtrl: NavController, public navParams: NavParams, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController, private toastCtrl: ToastController) {
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.master_id = this.navParams.get('vmID');
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad UpdateMasterPage');
    }

    updateMasterData () {
        (this.userPostData.remove == true) ? this.userPostData.remove = 1 : this.userPostData.remove = 0;

        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        loading.present();

        let logRes = this.authServiceProvider.postData(this.userPostData, 'master_server_update');

        if (logRes['error'] === false) {
            console.log(logRes['message']);
            loading.onDidDismiss(() => {
                this.reloadDashboard();
            });
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

    reloadDashboard() {
        this.navCtrl.popTo(DashboardPage);
    }
}
