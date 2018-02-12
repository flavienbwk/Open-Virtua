import {Component} from '@angular/core';
import {IonicPage, NavController, LoadingController, ToastController} from 'ionic-angular';

import {AuthServiceProvider} from "../../providers/auth-service/auth-service";

import {LoginPage} from "../login/login";

/**
 * Generated class for the SignupPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-signup',
    templateUrl: 'signup.html',
})
export class SignupPage {

    reponseData: any;
    public userData = {'username': '', 'password': '', 'email': '', 'phonenumber': ''};

    constructor(public navCtrl: NavController, public authServiceProvider: AuthServiceProvider, public loadingCtrl: LoadingController, private toastCtrl: ToastController) {
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad SignupPage');
    }

    signup() {
        let loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();

        let logRes = this.authServiceProvider.postData(this.userData, 'register');

        if(logRes['error'] === false) {
            this.reponseData = logRes['results'];
            localStorage.setItem('userData', JSON.stringify(this.userData));

            loading.onDidDismiss(() => {
                this.login();
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

    login() {
        this.navCtrl.push(LoginPage);
    }
}
