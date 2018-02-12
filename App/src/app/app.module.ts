import {NgModule, ErrorHandler} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {IonicApp, IonicModule, IonicErrorHandler} from 'ionic-angular';

import {MyApp} from './app.component';
import {WelcomePage} from '../pages/welcome/welcome';

import {LoginPage} from '../pages/login/login';
import {SignupPage} from '../pages/signup/signup';
import {LogoutPage} from "../pages/logout/logout";

import {DashboardPage} from "../pages/dashboard/dashboard";
import {AboutPage} from '../pages/about/about';

import {ShowMasterDetailPage} from "../pages/show-master-detail/show-master-detail";
import {AddMasterServerPage} from "../pages/add-master-server/add-master-server";
import {UpdateMasterPage} from "../pages/update-master/update-master";

import {ShowSlaveDetailPage} from "../pages/show-slave-detail/show-slave-detail";
import {AddSlaveServerPage} from "../pages/add-slave-server/add-slave-server";
import {SlavePreseedPage} from "../pages/slave-preseed/slave-preseed";
import {SlaveHypervisorSelectionPage} from "../pages/slave-hypervisor-selection/slave-hypervisor-selection";
import {SlaveDistributionSelectionPage} from "../pages/slave-distribution-selection/slave-distribution-selection";

import {TabsPage} from '../pages/tabs/tabs';
import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';

import {AuthServiceProvider} from '../providers/auth-service/auth-service';
import {HttpClientModule} from "@angular/common/http";

@NgModule({
    declarations: [
        MyApp,
        WelcomePage,

        LoginPage,
        SignupPage,
        LogoutPage,

        DashboardPage,
        AboutPage,

        ShowMasterDetailPage,
        AddMasterServerPage,
        UpdateMasterPage,

        ShowSlaveDetailPage,
        AddSlaveServerPage,
        SlavePreseedPage,
        SlaveHypervisorSelectionPage,
        SlaveDistributionSelectionPage,

        TabsPage
    ],
    imports: [
        BrowserModule,
        IonicModule.forRoot(MyApp),
        HttpClientModule
    ],
    bootstrap: [IonicApp],
    entryComponents: [
        MyApp,
        WelcomePage,

        LoginPage,
        SignupPage,
        LogoutPage,

        DashboardPage,
        AboutPage,

        ShowMasterDetailPage,
        AddMasterServerPage,
        UpdateMasterPage,

        ShowSlaveDetailPage,
        AddSlaveServerPage,
        SlavePreseedPage,
        SlaveHypervisorSelectionPage,
        SlaveDistributionSelectionPage,

        TabsPage
    ],
    providers: [
        StatusBar,
        SplashScreen,
        {provide: ErrorHandler, useClass: IonicErrorHandler},
        AuthServiceProvider
    ]
})
export class AppModule {
}
