import {Component} from '@angular/core';
import {IonicPage, NavController, LoadingController, ToastController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";

import {TabsPage} from "../tabs/tabs";
import {SignupPage} from "../signup/signup";

/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-login',
    templateUrl: 'login.html',
})
export class LoginPage {

    public userData = {'username':'', 'password':''};

    constructor(public navCtrl: NavController, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController, private toastCtrl: ToastController) {
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad LoginPage');
    }

    login() {

        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });

        let logRes = this.authServiceProvider.postData(this.userData, 'login');

        if(logRes['error'] === false) {
            loading.present();

            localStorage.setItem('user_id', logRes['results']['user_id']);
            localStorage.setItem('token_id', logRes['results']['token_id']);
            localStorage.setItem('token_expiration', logRes['results']['expiration']);

            loading.onDidDismiss(() => {
                this.navCtrl.push(TabsPage);
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

    signup() {
        this.navCtrl.push(SignupPage);
    }
}
