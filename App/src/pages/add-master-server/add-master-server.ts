import {Component} from '@angular/core';
import {IonicPage, NavController, LoadingController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";
import {DashboardPage} from "../dashboard/dashboard";

/**
 * Generated class for the AddMasterServerPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-add-master-server',
    templateUrl: 'add-master-server.html',
})
export class AddMasterServerPage {

    public userPostData = {
        'token_id': '',
        'user_id': '',
        'name': '',
        'ip': '',
        'ssh_port': 22,
        'username': '',
        'password': '',
        'memory': '',
        'storage': ''
    };

    public userTokenExpire: any;

    public vms: any;
    public vm_detail_id: any;

    constructor(public navCtrl: NavController, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController) {
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userTokenExpire = localStorage.getItem('token_expiration');
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad AddMasterServerPage');
    }

    addMaster() {
        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();

        let logRes = this.authServiceProvider.postData(this.userPostData, 'add_master_server');

        if (logRes['error'] === false) {
            console.log(logRes['message']);
            loading.onDidDismiss(() => {
                this.reloadDashboard();
            });
            loading.dismiss();
        } else {
            console.log(logRes['message']);
            loading.dismiss();
        }
    }

    reloadDashboard() {
        this.navCtrl.popTo(DashboardPage);
    }

}
