import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams, LoadingController, ToastController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";

import {SlaveDistributionSelectionPage} from "../slave-distribution-selection/slave-distribution-selection";

/**
 * Generated class for the SlaveHypervisorSelectionPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-slave-hypervisor-selection',
    templateUrl: 'slave-hypervisor-selection.html',
})
export class SlaveHypervisorSelectionPage {

    public userPostData = {
        'token_id': '',
        'user_id': ''
    };

    public hypervisors: any;

    constructor(public navCtrl: NavController, public navParams: NavParams, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController, private toastCtrl: ToastController) {
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');

        this.loadHypervisors();
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad SlaveHypervisorSelectionPage');
    }

    loadHypervisors () {
        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        loading.present();

        let logRes = this.authServiceProvider.postData(this.userPostData, 'hypervisors_list');

        if (logRes['error'] === false) {
            this.hypervisors = logRes['results']['list'];

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

    selectHypervisors (hypervisor_id) {
        this.navCtrl.push(SlaveDistributionSelectionPage, {'hypervisor_ID': hypervisor_id});
    }
}
