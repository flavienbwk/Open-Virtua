webpackJsonp([13],{

/***/ 104:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AddMasterServerPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__dashboard_dashboard__ = __webpack_require__(42);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




/**
 * Generated class for the AddMasterServerPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var AddMasterServerPage = (function () {
    function AddMasterServerPage(navCtrl, authServiceProvider, loadingCtrl) {
        this.navCtrl = navCtrl;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.userPostData = {
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
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userTokenExpire = localStorage.getItem('token_expiration');
    }
    AddMasterServerPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad AddMasterServerPage');
    };
    AddMasterServerPage.prototype.addMaster = function () {
        var _this = this;
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'add_master_server');
        if (logRes['error'] === false) {
            console.log(logRes['message']);
            loading.onDidDismiss(function () {
                _this.reloadDashboard();
            });
            loading.dismiss();
        }
        else {
            console.log(logRes['message']);
            loading.dismiss();
        }
    };
    AddMasterServerPage.prototype.reloadDashboard = function () {
        this.navCtrl.popTo(__WEBPACK_IMPORTED_MODULE_3__dashboard_dashboard__["a" /* DashboardPage */]);
    };
    AddMasterServerPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-add-master-server',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/add-master-server/add-master-server.html"*/'<!--\n  Generated template for the AddMasterServerPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n    <ion-navbar>\n        <ion-title>Master Server Creation</ion-title>\n    </ion-navbar>\n\n</ion-header>\n\n\n<ion-content padding>\n    <ion-list>\n        <ion-item>\n            <ion-input placeholder="Master name*" type="text" value="" [(ngModel)]="userPostData.name"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="Bind IP*" type="text" value="" [(ngModel)]="userPostData.ip"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="SSH Port* (default: 22)" type="number" value=""\n                       [(ngModel)]="userPostData.ssh_port"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="User username*" type="text" value=""\n                       [(ngModel)]="userPostData.username"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="User password*" type="password" minlength="4"\n                       [(ngModel)]="userPostData.password"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="(Optional) Memory (in Mo)" type="number" value=""\n                       [(ngModel)]="userPostData.memory"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="(Optional) Storage (in Mo)" type="number" value=""\n                       [(ngModel)]="userPostData.storage"></ion-input>\n        </ion-item>\n\n    </ion-list>\n    <div padding>\n        <button ion-button full round color="primary" (click)="addMaster()">Create MS</button>\n    </div>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/add-master-server/add-master-server.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */]])
    ], AddMasterServerPage);
    return AddMasterServerPage;
}());

//# sourceMappingURL=add-master-server.js.map

/***/ }),

/***/ 105:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return UpdateMasterPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__dashboard_dashboard__ = __webpack_require__(42);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




/**
 * Generated class for the UpdateMasterPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var UpdateMasterPage = (function () {
    function UpdateMasterPage(navCtrl, navParams, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPostData = {
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
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.master_id = this.navParams.get('vmID');
    }
    UpdateMasterPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad UpdateMasterPage');
    };
    UpdateMasterPage.prototype.updateMasterData = function () {
        var _this = this;
        (this.userPostData.remove == true) ? this.userPostData.remove = 1 : this.userPostData.remove = 0;
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'master_server_update');
        if (logRes['error'] === false) {
            console.log(logRes['message']);
            loading.onDidDismiss(function () {
                _this.reloadDashboard();
            });
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    UpdateMasterPage.prototype.reloadDashboard = function () {
        this.navCtrl.popTo(__WEBPACK_IMPORTED_MODULE_3__dashboard_dashboard__["a" /* DashboardPage */]);
    };
    UpdateMasterPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-update-master',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/update-master/update-master.html"*/'<!--\n  Generated template for the AddMasterServerPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n    <ion-navbar>\n        <ion-title>Update Master Server</ion-title>\n    </ion-navbar>\n\n</ion-header>\n\n\n<ion-content padding>\n    <ion-list>\n\n        <ion-item>\n            <ion-label> (Optional) Remove</ion-label>\n            <ion-toggle color="danger" checked="false" [(ngModel)]="userPostData.remove"></ion-toggle>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="SSH Port (default: 22)" type="number" value=""\n                       [(ngModel)]="userPostData.ssh_port"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="User username" type="text" value=""\n                       [(ngModel)]="userPostData.username"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="User password" type="password" minlength="4"\n                       [(ngModel)]="userPostData.password"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="(Optional) Memory (in Mo)" type="number" value=""\n                       [(ngModel)]="userPostData.memory"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="(Optional) Storage (in Mo)" type="number" value=""\n                       [(ngModel)]="userPostData.storage"></ion-input>\n        </ion-item>\n\n    </ion-list>\n    <div padding>\n        <button ion-button full round color="primary" (click)="updateMasterData()">Update MS</button>\n    </div>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/update-master/update-master.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]])
    ], UpdateMasterPage);
    return UpdateMasterPage;
}());

//# sourceMappingURL=update-master.js.map

/***/ }),

/***/ 106:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ShowSlaveDetailPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



/**
 * Generated class for the ShowSlaveDetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var ShowSlaveDetailPage = (function () {
    function ShowSlaveDetailPage(navCtrl, navParams, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPostData = {
            'token_id': '',
            'user_id': '',
            'master_id': '',
            'slave_id': ''
        };
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.master_id = localStorage.getItem('vmID');
        this.userPostData.slave_id = this.navParams.get('slaveID');
        this.loadSlaveDetail();
    }
    ShowSlaveDetailPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad ShowSlaveDetailPage');
    };
    ShowSlaveDetailPage.prototype.loadSlaveDetail = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'slave_server_details');
        if (logRes['error'] === false) {
            this.slave_detail = logRes['results'];
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    ShowSlaveDetailPage.prototype.removeSlave = function (hypervisorID) {
        var postData = {
            'token_id': this.userPostData.token_id,
            'user_id': this.userPostData.user_id,
            'master_id': this.userPostData.master_id,
            'hypervisor_id': hypervisorID,
            'slave_id': this.userPostData.slave_id
        };
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(postData, 'slave_server_remove');
        if (logRes['error'] === false) {
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    ShowSlaveDetailPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-show-slave-detail',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/show-slave-detail/show-slave-detail.html"*/'<!--\n  Generated template for the ShowSlaveDetailPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n    <ion-navbar>\n        <ion-title>VM Infos</ion-title>\n    </ion-navbar>\n\n</ion-header>\n\n\n<ion-content class="card-background-page">\n    <!-- MASTER DETAILS -->\n    <ion-card>\n        <ion-card-header>\n            {{slave_detail[\'name\']}}\n        </ion-card-header>\n\n        <ion-list class="card-subtitle">\n            <div ion-item>\n                <ion-icon name="git-network" item-start></ion-icon>\n                Hyperv. - {{slave_detail[\'hypervisor_name\']}}\n            </div>\n            <div ion-item>\n                <ion-icon name="git-network" item-start></ion-icon>\n                Distrib. - {{slave_detail[\'distribution_name\']}}\n            </div>\n            <div ion-item>\n                <ion-icon name="at" item-start></ion-icon>\n                IP - {{slave_detail[\'ip\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="finger-print" item-start></ion-icon>\n                Mac - {{slave_detail[\'mac\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="eye" item-start></ion-icon>\n                Gateway - {{slave_detail[\'gateway\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="crop" item-start></ion-icon>\n                RAM - {{slave_detail[\'memory\']}} Mo\n            </div>\n\n            <div ion-item>\n                <ion-icon name="disc" item-start></ion-icon>\n                Storage - {{slave_detail[\'storage\']}} Mo\n            </div>\n        </ion-list>\n    </ion-card>\n    <button disabled ion-button icon-right (click)="removeSlave(slave_detail[\'hypervisor_id\'])">\n        Remove\n        <ion-icon name="ios-cog-outline"></ion-icon>\n    </button>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/show-slave-detail/show-slave-detail.html"*/,
        }),
        __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */]) === "function" && _a || Object, typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */]) === "function" && _b || Object, typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */]) === "function" && _c || Object, typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */]) === "function" && _d || Object, typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]) === "function" && _e || Object])
    ], ShowSlaveDetailPage);
    return ShowSlaveDetailPage;
    var _a, _b, _c, _d, _e;
}());

//# sourceMappingURL=show-slave-detail.js.map

/***/ }),

/***/ 107:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return SlavePreseedPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



/**
 * Generated class for the SlavePreseedPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var SlavePreseedPage = (function () {
    function SlavePreseedPage(navCtrl, navParams, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPreseedsData = {
            'token_id': '',
            'user_id': '',
            'distribution_id': ''
        };
        this.userPostData = {
            'token_id': '',
            'user_id': '',
            'master_id': '',
            'slave_id': ''
        };
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.master_id = localStorage.getItem('vmID');
        this.userPostData.slave_id = this.navParams.get('slaveID');
        this.userPreseedsData.token_id = this.userPostData.token_id;
        this.userPreseedsData.user_id = this.userPostData.user_id;
        this.userPreseedsData.distribution_id = this.navParams.get('distributionID');
        this.loadPreseedForDistribution();
        this.loadSlavePreseed();
    }
    SlavePreseedPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad SlavePreseedPage');
    };
    SlavePreseedPage.prototype.loadPreseedForDistribution = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPreseedsData, 'preseeds_list');
        if (logRes['error'] === false) {
            this.preseed_distrib = logRes['results']['list'];
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    SlavePreseedPage.prototype.loadSlavePreseed = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'slave_preseed_list');
        if (logRes['error'] === false) {
            this.slave_preseed = logRes['results']['list'];
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    SlavePreseedPage.prototype.addSlavePreseed = function (preseed_id) {
        var postData = {
            'token_id': this.userPostData.token_id,
            'user_id': this.userPostData.user_id,
            'preseed_id': preseed_id,
            'slave_id': this.userPostData.slave_id,
            'master_id': this.userPostData.master_id,
            'execution_order': 0
        };
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(postData, 'slave_preseed_add');
        var toast = this.toastCtrl.create({
            message: logRes['message'],
            duration: 3000,
            position: 'bottom'
        });
        loading.dismiss();
        toast.present();
    };
    SlavePreseedPage.prototype.removePreseed = function (preseed_id) {
        var postData = {
            'token_id': localStorage.getItem('token_id'),
            'user_id': localStorage.getItem('user_id'),
            'preseed_id': preseed_id
        };
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(postData, 'preseeds_remove');
        var toast = this.toastCtrl.create({
            message: logRes['message'],
            duration: 3000,
            position: 'bottom'
        });
        loading.dismiss();
        toast.present();
    };
    SlavePreseedPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-slave-preseed',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/slave-preseed/slave-preseed.html"*/'<!--\n  Generated template for the SlavePreseedPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n    <ion-navbar>\n        <ion-title>Slave Preseeds</ion-title>\n    </ion-navbar>\n\n</ion-header>\n\n<ion-content class="card-background-page">\n    <!-- Slave Preseed LIST -->\n    <ion-card *ngFor="let item of slave_preseed">\n        <ion-list class="card-subtitle">\n            <div ion-item>\n                <ion-icon name="globe" item-start></ion-icon>\n                ID - {{item[\'preseed_id\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="finger-print" item-start></ion-icon>\n                Exec order - {{item[\'execution_order\']}}\n            </div>\n            <div ion-item>\n                <button ion-button (click)="addSlavePreseed(\'0\')">\n                    <ion-icon item-start name="ios-information-circle-outline"></ion-icon>\n                    Add\n                </button>\n\n                <button ion-button icon-right (click)="addSlavePreseed(\'0\')">\n                    Remove\n                    <ion-icon name="ios-cog-outline"></ion-icon>\n                </button>\n            </div>\n        </ion-list>\n    </ion-card>\n\n    <!-- Preseed LIST -->\n    <ion-card *ngFor="let item of preseed_distrib">\n        <ion-list class="card-subtitle">\n            <div ion-item>\n                <ion-icon name="globe" item-start></ion-icon>\n                Name - {{item[\'name\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="finger-print" item-start></ion-icon>\n                Script - {{item[\'script\']}}\n            </div>\n            <div ion-item>\n                <button ion-button (click)="addSlavePreseed(item[\'preseed_id\'])">\n                    <ion-icon item-start name="ios-information-circle-outline"></ion-icon>\n                    Add for the VM\n                </button>\n\n                <button ion-button icon-right (click)="removePreseed(item[\'preseed_id\'])">\n                    Remove for distribution\n                    <ion-icon name="ios-cog-outline"></ion-icon>\n                </button>\n            </div>\n        </ion-list>\n    </ion-card>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/slave-preseed/slave-preseed.html"*/,
        }),
        __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */]) === "function" && _a || Object, typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */]) === "function" && _b || Object, typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */]) === "function" && _c || Object, typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */]) === "function" && _d || Object, typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]) === "function" && _e || Object])
    ], SlavePreseedPage);
    return SlavePreseedPage;
    var _a, _b, _c, _d, _e;
}());

//# sourceMappingURL=slave-preseed.js.map

/***/ }),

/***/ 108:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return SlaveHypervisorSelectionPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__slave_distribution_selection_slave_distribution_selection__ = __webpack_require__(109);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




/**
 * Generated class for the SlaveHypervisorSelectionPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var SlaveHypervisorSelectionPage = (function () {
    function SlaveHypervisorSelectionPage(navCtrl, navParams, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPostData = {
            'token_id': '',
            'user_id': ''
        };
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.loadHypervisors();
    }
    SlaveHypervisorSelectionPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad SlaveHypervisorSelectionPage');
    };
    SlaveHypervisorSelectionPage.prototype.loadHypervisors = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'hypervisors_list');
        if (logRes['error'] === false) {
            this.hypervisors = logRes['results']['list'];
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    SlaveHypervisorSelectionPage.prototype.selectHypervisors = function (hypervisor_id) {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_3__slave_distribution_selection_slave_distribution_selection__["a" /* SlaveDistributionSelectionPage */], { 'hypervisor_ID': hypervisor_id });
    };
    SlaveHypervisorSelectionPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-slave-hypervisor-selection',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/slave-hypervisor-selection/slave-hypervisor-selection.html"*/'<!--\n  Generated template for the SlaveHypervisorSelectionPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n  <ion-navbar>\n    <ion-title>(1/3) - Hypervisors</ion-title>\n  </ion-navbar>\n\n</ion-header>\n\n<ion-content>\n    <ion-list>\n      <button ion-item *ngFor="let item of hypervisors" (click)="selectHypervisors(item[\'hypervisor_id\'])">\n        <ion-icon name="git-network" item-start></ion-icon>\n        {{item[\'name\']}}\n      </button>\n    </ion-list>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/slave-hypervisor-selection/slave-hypervisor-selection.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]])
    ], SlaveHypervisorSelectionPage);
    return SlaveHypervisorSelectionPage;
}());

//# sourceMappingURL=slave-hypervisor-selection.js.map

/***/ }),

/***/ 109:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return SlaveDistributionSelectionPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__add_slave_server_add_slave_server__ = __webpack_require__(110);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




/**
 * Generated class for the SlaveDistributionSelectionPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var SlaveDistributionSelectionPage = (function () {
    function SlaveDistributionSelectionPage(navCtrl, navParams, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPostData = {
            'token_id': '',
            'user_id': '',
            'hypervisor_id': ''
        };
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.hypervisor_id = this.navParams.get('hypervisor_ID');
        this.loadDistributions();
    }
    SlaveDistributionSelectionPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad SlaveHypervisorSelectionPage');
    };
    SlaveDistributionSelectionPage.prototype.loadDistributions = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'distributions_list');
        if (logRes['error'] === false) {
            this.distributions = logRes['results']['list'];
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    SlaveDistributionSelectionPage.prototype.selectDistribution = function (distribution_id) {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_3__add_slave_server_add_slave_server__["a" /* AddSlaveServerPage */], { 'hypervisor_ID': this.userPostData.hypervisor_id, 'distribution_ID': distribution_id });
    };
    SlaveDistributionSelectionPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-slave-distribution-selection',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/slave-distribution-selection/slave-distribution-selection.html"*/'<!--\n  Generated template for the SlaveDistributionSelectionPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n  <ion-navbar>\n    <ion-title>(2/3) - Distribution</ion-title>\n  </ion-navbar>\n\n</ion-header>\n\n\n<ion-content>\n  <ion-list>\n    <button ion-item *ngFor="let item of distributions" (click)="selectDistribution(item[\'distribution_id\'])">\n      <ion-icon name="git-network" item-start></ion-icon>\n      {{item[\'distribution_name\']}}\n    </button>\n  </ion-list>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/slave-distribution-selection/slave-distribution-selection.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]])
    ], SlaveDistributionSelectionPage);
    return SlaveDistributionSelectionPage;
}());

//# sourceMappingURL=slave-distribution-selection.js.map

/***/ }),

/***/ 110:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AddSlaveServerPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__show_master_detail_show_master_detail__ = __webpack_require__(52);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




/**
 * Generated class for the AddSlaveServerPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var AddSlaveServerPage = (function () {
    function AddSlaveServerPage(navCtrl, navParams, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPostData = {
            'token_id': '',
            'user_id': '',
            'master_id': '',
            'hypervisor_id': '',
            'distribution_id': '',
            'name': '',
            'username': '',
            'password': '',
            'memory': '',
            'storage': ''
        };
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.hypervisor_id = this.navParams.get('hypervisor_ID');
        this.userPostData.distribution_id = this.navParams.get('distribution_ID');
    }
    AddSlaveServerPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad AddSlaveServerPage');
    };
    AddSlaveServerPage.prototype.createSlave = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        var logRes = this.authServiceProvider.postData(this.userPostData, 'slave_server_create');
        if (logRes['error'] === false) {
            localStorage.setItem('vmID', this.userPostData.master_id);
            loading.dismiss();
            this.navCtrl.popTo(__WEBPACK_IMPORTED_MODULE_3__show_master_detail_show_master_detail__["a" /* ShowMasterDetailPage */]);
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    AddSlaveServerPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-add-slave-server',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/add-slave-server/add-slave-server.html"*/'<!--\n  Generated template for the AddSlaveServerPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n    <ion-navbar>\n        <ion-title>(3/3) - VM Configuration</ion-title>\n    </ion-navbar>\n\n</ion-header>\n\n<ion-content padding>\n    <ion-list>\n        <ion-item>\n            <ion-input placeholder="Name*" type="text" value="" [(ngModel)]="userPostData.name"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="Username*" type="text" value="" [(ngModel)]="userPostData.username"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="Password*" type="password" value=""\n                       [(ngModel)]="userPostData.password"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="Memory*" type="number" value=""\n                       [(ngModel)]="userPostData.memory"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-input placeholder="Storage*" type="number" value=""\n                       [(ngModel)]="userPostData.storage"></ion-input>\n        </ion-item>\n\n    </ion-list>\n    <div padding>\n        <button ion-button full round color="primary" (click)="createSlave()">Create VM</button>\n    </div>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/add-slave-server/add-slave-server.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]])
    ], AddSlaveServerPage);
    return AddSlaveServerPage;
}());

//# sourceMappingURL=add-slave-server.js.map

/***/ }),

/***/ 111:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LogoutPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


/**
 * Generated class for the LogoutPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var LogoutPage = (function () {
    function LogoutPage(navCtrl, app) {
        this.navCtrl = navCtrl;
        this.app = app;
        localStorage.clear();
        var root = this.app.getRootNav();
        root.popToRoot();
    }
    LogoutPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad LogoutPage');
    };
    LogoutPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-logout',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/logout/logout.html"*/'<!--\n  Generated template for the LogoutPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/logout/logout.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["a" /* App */]])
    ], LogoutPage);
    return LogoutPage;
}());

//# sourceMappingURL=logout.js.map

/***/ }),

/***/ 112:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return WelcomePage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__login_login__ = __webpack_require__(53);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__signup_signup__ = __webpack_require__(54);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




/**
 * Generated class for the WelcomePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var WelcomePage = (function () {
    function WelcomePage(navCtrl, navParams) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
    }
    WelcomePage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad WelcomePage');
    };
    WelcomePage.prototype.login = function () {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_2__login_login__["a" /* LoginPage */]);
    };
    WelcomePage.prototype.signup = function () {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_3__signup_signup__["a" /* SignupPage */]);
    };
    WelcomePage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-welcome',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/welcome/welcome.html"*/'<!--\n  Generated template for the WelcomePage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n\n<ion-content class="landing">\n    <div class="welcome-button_container">\n        <button ion-button small class="welcome-button big" (click)="login()">Log in</button>\n        <button ion-button small clear class="welcome-button big" (click)="signup()">Or create an account</button>\n    </div>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/welcome/welcome.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */]])
    ], WelcomePage);
    return WelcomePage;
}());

//# sourceMappingURL=welcome.js.map

/***/ }),

/***/ 125:
/***/ (function(module, exports) {

function webpackEmptyAsyncContext(req) {
	// Here Promise.resolve().then() is used instead of new Promise() to prevent
	// uncatched exception popping up in devtools
	return Promise.resolve().then(function() {
		throw new Error("Cannot find module '" + req + "'.");
	});
}
webpackEmptyAsyncContext.keys = function() { return []; };
webpackEmptyAsyncContext.resolve = webpackEmptyAsyncContext;
module.exports = webpackEmptyAsyncContext;
webpackEmptyAsyncContext.id = 125;

/***/ }),

/***/ 13:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AuthServiceProvider; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_common_http__ = __webpack_require__(168);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__(0);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var API_ACCES_KEY = 'x-ov-api-key';
var API_ACCESS_VALUE = '1c392287e4ee980d0f5d5ed2a91e3422b482ba34';
var API_URLS = {
    'test': 'https://flavien.berwick.fr/projects/etna/open-virtua/api',
    'register': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/register',
    'login': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/login',
    'token_check': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/login/check',
    'master_server_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/master/list',
    'add_master_server': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/master/add',
    'master_server_update': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/master/update',
    'master_server_details': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/master/details',
    'slave_server_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/list',
    'slave_server_create': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/create',
    'slave_server_remove': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/remove',
    'slave_server_details': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/details',
    'slave_preseed_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/preseeds',
    'slave_preseed_add': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/preseeds/add',
    'slave_preseed_remove': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/preseeds/remove',
    'hypervisors_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/hypervisor/list',
    'distributions_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/hypervisor/distributions',
    'preseeds_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/distributions/preseeds',
    'preseeds_add': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/distributions/preseed/create',
    'preseeds_remove': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/distributions/preseed/remove'
};
/*
  Generated class for the AuthServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
var AuthServiceProvider = (function () {
    function AuthServiceProvider(http) {
        this.http = http;
    }
    AuthServiceProvider.prototype.postData = function (credentials, urlIndex) {
        var xml = new XMLHttpRequest();
        xml.open('POST', API_URLS[urlIndex], false);
        xml.setRequestHeader(API_ACCES_KEY, API_ACCESS_VALUE);
        xml.send(this.formatCredentials(credentials));
        return JSON.parse(xml.response);
    };
    AuthServiceProvider.prototype.formatCredentials = function (credentials) {
        var data = new FormData();
        // LOGIN - REGISTER - CREDENTIALS //
        if (credentials['username'] != null) {
            data.append('username', credentials['username']);
        }
        if (credentials['password'] != null) {
            data.append('password', credentials['password']);
        }
        if (credentials['email'] != "") {
            data.append('email', credentials['email']);
        }
        if (credentials['phonenumber'] != "") {
            data.append('phonenumber', credentials['phonenumber']);
        }
        // --------------------------- //
        // MASTER SERVER - CREDENTIALS //
        if (credentials['user_id'] != null) {
            data.append('user_id', credentials['user_id']);
        }
        if (credentials['token_id'] != null) {
            data.append('token_id', credentials['token_id']);
        }
        if (credentials['master_id'] != null) {
            data.append('master_id', credentials['master_id']);
        }
        if (credentials['name'] != null) {
            data.append('name', credentials['name']);
        }
        if (credentials['ip'] != null) {
            data.append('ip', credentials['ip']);
        }
        if (credentials['ssh_port'] != null) {
            data.append('ssh_port', credentials['ssh_port']);
        }
        if (credentials['memory'] != null) {
            data.append('memory', credentials['memory']);
        }
        if (credentials['storage'] != null) {
            data.append('storage', credentials['storage']);
        }
        if (credentials['remove'] != null) {
            data.append('remove', credentials['remove']);
        }
        // --------------------------- //
        // SLAVE SERVER - CREDENTIALS //
        if (credentials['hypervisor_id'] != null) {
            data.append('hypervisor_id', credentials['hypervisor_id']);
        }
        if (credentials['distribution_id'] != null) {
            data.append('distribution_id', credentials['distribution_id']);
        }
        if (credentials['slave_id'] != null) {
            data.append('slave_id', credentials['slave_id']);
        }
        // --------------------------- //
        // SLAVE PRESEED - CREDENTIALS //
        if (credentials['preseed_id'] != null) {
            data.append('preseed_id', credentials['preseed_id']);
        }
        if (credentials['execution_order'] != null) {
            data.append('execution_order', credentials['execution_order']);
        }
        // --------------------------- //
        return data;
    };
    AuthServiceProvider = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_1__angular_core__["A" /* Injectable */])(),
        __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__angular_common_http__["a" /* HttpClient */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_0__angular_common_http__["a" /* HttpClient */]) === "function" && _a || Object])
    ], AuthServiceProvider);
    return AuthServiceProvider;
    var _a;
}());

//# sourceMappingURL=auth-service.js.map

/***/ }),

/***/ 167:
/***/ (function(module, exports, __webpack_require__) {

var map = {
	"../pages/add-master-server/add-master-server.module": [
		292,
		12
	],
	"../pages/add-slave-server/add-slave-server.module": [
		293,
		11
	],
	"../pages/dashboard/dashboard.module": [
		294,
		10
	],
	"../pages/login/login.module": [
		295,
		9
	],
	"../pages/logout/logout.module": [
		296,
		8
	],
	"../pages/show-master-detail/show-master-detail.module": [
		297,
		7
	],
	"../pages/show-slave-detail/show-slave-detail.module": [
		298,
		6
	],
	"../pages/signup/signup.module": [
		299,
		5
	],
	"../pages/slave-distribution-selection/slave-distribution-selection.module": [
		300,
		4
	],
	"../pages/slave-hypervisor-selection/slave-hypervisor-selection.module": [
		301,
		3
	],
	"../pages/slave-preseed/slave-preseed.module": [
		302,
		2
	],
	"../pages/update-master/update-master.module": [
		303,
		1
	],
	"../pages/welcome/welcome.module": [
		304,
		0
	]
};
function webpackAsyncContext(req) {
	var ids = map[req];
	if(!ids)
		return Promise.reject(new Error("Cannot find module '" + req + "'."));
	return __webpack_require__.e(ids[1]).then(function() {
		return __webpack_require__(ids[0]);
	});
};
webpackAsyncContext.keys = function webpackAsyncContextKeys() {
	return Object.keys(map);
};
webpackAsyncContext.id = 167;
module.exports = webpackAsyncContext;

/***/ }),

/***/ 169:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return TabsPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__about_about__ = __webpack_require__(170);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__dashboard_dashboard__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__logout_logout__ = __webpack_require__(111);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var TabsPage = (function () {
    function TabsPage() {
        this.tab1Root = __WEBPACK_IMPORTED_MODULE_2__dashboard_dashboard__["a" /* DashboardPage */];
        this.tab2Root = __WEBPACK_IMPORTED_MODULE_1__about_about__["a" /* AboutPage */];
        this.tab3Root = __WEBPACK_IMPORTED_MODULE_3__logout_logout__["a" /* LogoutPage */];
    }
    TabsPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/tabs/tabs.html"*/'<ion-tabs>\n  <ion-tab [root]="tab1Root" tabTitle="Dashboard" tabIcon="aperture"></ion-tab>\n  <ion-tab [root]="tab2Root" tabTitle="About" tabIcon="information-circle"></ion-tab>\n  <ion-tab [root]="tab3Root" tabTitle="Log out" tabIcon="log-out"></ion-tab>\n</ion-tabs>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/tabs/tabs.html"*/
        }),
        __metadata("design:paramtypes", [])
    ], TabsPage);
    return TabsPage;
}());

//# sourceMappingURL=tabs.js.map

/***/ }),

/***/ 170:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AboutPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var AboutPage = (function () {
    function AboutPage(navCtrl) {
        this.navCtrl = navCtrl;
    }
    AboutPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-about',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/about/about.html"*/'<ion-header>\n  <ion-navbar>\n    <ion-title>\n      About\n    </ion-title>\n  </ion-navbar>\n</ion-header>\n\n<ion-content padding>\n\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/about/about.html"*/
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */]])
    ], AboutPage);
    return AboutPage;
}());

//# sourceMappingURL=about.js.map

/***/ }),

/***/ 214:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_platform_browser_dynamic__ = __webpack_require__(215);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app_module__ = __webpack_require__(236);


Object(__WEBPACK_IMPORTED_MODULE_0__angular_platform_browser_dynamic__["a" /* platformBrowserDynamic */])().bootstrapModule(__WEBPACK_IMPORTED_MODULE_1__app_module__["a" /* AppModule */]);
//# sourceMappingURL=main.js.map

/***/ }),

/***/ 236:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__ = __webpack_require__(31);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__app_component__ = __webpack_require__(283);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__pages_welcome_welcome__ = __webpack_require__(112);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__pages_login_login__ = __webpack_require__(53);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__pages_signup_signup__ = __webpack_require__(54);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__pages_logout_logout__ = __webpack_require__(111);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__pages_dashboard_dashboard__ = __webpack_require__(42);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__pages_about_about__ = __webpack_require__(170);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__pages_show_master_detail_show_master_detail__ = __webpack_require__(52);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__pages_add_master_server_add_master_server__ = __webpack_require__(104);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__pages_update_master_update_master__ = __webpack_require__(105);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__pages_show_slave_detail_show_slave_detail__ = __webpack_require__(106);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__pages_add_slave_server_add_slave_server__ = __webpack_require__(110);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__pages_slave_preseed_slave_preseed__ = __webpack_require__(107);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__pages_slave_hypervisor_selection_slave_hypervisor_selection__ = __webpack_require__(108);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__pages_slave_distribution_selection_slave_distribution_selection__ = __webpack_require__(109);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__pages_tabs_tabs__ = __webpack_require__(169);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__ionic_native_status_bar__ = __webpack_require__(210);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_20__ionic_native_splash_screen__ = __webpack_require__(213);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_21__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_22__angular_common_http__ = __webpack_require__(168);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};























var AppModule = (function () {
    function AppModule() {
    }
    AppModule = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["I" /* NgModule */])({
            declarations: [
                __WEBPACK_IMPORTED_MODULE_3__app_component__["a" /* MyApp */],
                __WEBPACK_IMPORTED_MODULE_4__pages_welcome_welcome__["a" /* WelcomePage */],
                __WEBPACK_IMPORTED_MODULE_5__pages_login_login__["a" /* LoginPage */],
                __WEBPACK_IMPORTED_MODULE_6__pages_signup_signup__["a" /* SignupPage */],
                __WEBPACK_IMPORTED_MODULE_7__pages_logout_logout__["a" /* LogoutPage */],
                __WEBPACK_IMPORTED_MODULE_8__pages_dashboard_dashboard__["a" /* DashboardPage */],
                __WEBPACK_IMPORTED_MODULE_9__pages_about_about__["a" /* AboutPage */],
                __WEBPACK_IMPORTED_MODULE_10__pages_show_master_detail_show_master_detail__["a" /* ShowMasterDetailPage */],
                __WEBPACK_IMPORTED_MODULE_11__pages_add_master_server_add_master_server__["a" /* AddMasterServerPage */],
                __WEBPACK_IMPORTED_MODULE_12__pages_update_master_update_master__["a" /* UpdateMasterPage */],
                __WEBPACK_IMPORTED_MODULE_13__pages_show_slave_detail_show_slave_detail__["a" /* ShowSlaveDetailPage */],
                __WEBPACK_IMPORTED_MODULE_14__pages_add_slave_server_add_slave_server__["a" /* AddSlaveServerPage */],
                __WEBPACK_IMPORTED_MODULE_15__pages_slave_preseed_slave_preseed__["a" /* SlavePreseedPage */],
                __WEBPACK_IMPORTED_MODULE_16__pages_slave_hypervisor_selection_slave_hypervisor_selection__["a" /* SlaveHypervisorSelectionPage */],
                __WEBPACK_IMPORTED_MODULE_17__pages_slave_distribution_selection_slave_distribution_selection__["a" /* SlaveDistributionSelectionPage */],
                __WEBPACK_IMPORTED_MODULE_18__pages_tabs_tabs__["a" /* TabsPage */]
            ],
            imports: [
                __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__["a" /* BrowserModule */],
                __WEBPACK_IMPORTED_MODULE_2_ionic_angular__["d" /* IonicModule */].forRoot(__WEBPACK_IMPORTED_MODULE_3__app_component__["a" /* MyApp */], {}, {
                    links: [
                        { loadChildren: '../pages/add-master-server/add-master-server.module#AddMasterServerPageModule', name: 'AddMasterServerPage', segment: 'add-master-server', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/add-slave-server/add-slave-server.module#AddSlaveServerPageModule', name: 'AddSlaveServerPage', segment: 'add-slave-server', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/dashboard/dashboard.module#DashboardPageModule', name: 'DashboardPage', segment: 'dashboard', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/login/login.module#LoginPageModule', name: 'LoginPage', segment: 'login', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/logout/logout.module#LogoutPageModule', name: 'LogoutPage', segment: 'logout', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/show-master-detail/show-master-detail.module#ShowMasterDetailPageModule', name: 'ShowMasterDetailPage', segment: 'show-master-detail', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/show-slave-detail/show-slave-detail.module#ShowSlaveDetailPageModule', name: 'ShowSlaveDetailPage', segment: 'show-slave-detail', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/signup/signup.module#SignupPageModule', name: 'SignupPage', segment: 'signup', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/slave-distribution-selection/slave-distribution-selection.module#SlaveDistributionSelectionPageModule', name: 'SlaveDistributionSelectionPage', segment: 'slave-distribution-selection', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/slave-hypervisor-selection/slave-hypervisor-selection.module#SlaveHypervisorSelectionPageModule', name: 'SlaveHypervisorSelectionPage', segment: 'slave-hypervisor-selection', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/slave-preseed/slave-preseed.module#SlavePreseedPageModule', name: 'SlavePreseedPage', segment: 'slave-preseed', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/update-master/update-master.module#UpdateMasterPageModule', name: 'UpdateMasterPage', segment: 'update-master', priority: 'low', defaultHistory: [] },
                        { loadChildren: '../pages/welcome/welcome.module#WelcomePageModule', name: 'WelcomePage', segment: 'welcome', priority: 'low', defaultHistory: [] }
                    ]
                }),
                __WEBPACK_IMPORTED_MODULE_22__angular_common_http__["b" /* HttpClientModule */]
            ],
            bootstrap: [__WEBPACK_IMPORTED_MODULE_2_ionic_angular__["b" /* IonicApp */]],
            entryComponents: [
                __WEBPACK_IMPORTED_MODULE_3__app_component__["a" /* MyApp */],
                __WEBPACK_IMPORTED_MODULE_4__pages_welcome_welcome__["a" /* WelcomePage */],
                __WEBPACK_IMPORTED_MODULE_5__pages_login_login__["a" /* LoginPage */],
                __WEBPACK_IMPORTED_MODULE_6__pages_signup_signup__["a" /* SignupPage */],
                __WEBPACK_IMPORTED_MODULE_7__pages_logout_logout__["a" /* LogoutPage */],
                __WEBPACK_IMPORTED_MODULE_8__pages_dashboard_dashboard__["a" /* DashboardPage */],
                __WEBPACK_IMPORTED_MODULE_9__pages_about_about__["a" /* AboutPage */],
                __WEBPACK_IMPORTED_MODULE_10__pages_show_master_detail_show_master_detail__["a" /* ShowMasterDetailPage */],
                __WEBPACK_IMPORTED_MODULE_11__pages_add_master_server_add_master_server__["a" /* AddMasterServerPage */],
                __WEBPACK_IMPORTED_MODULE_12__pages_update_master_update_master__["a" /* UpdateMasterPage */],
                __WEBPACK_IMPORTED_MODULE_13__pages_show_slave_detail_show_slave_detail__["a" /* ShowSlaveDetailPage */],
                __WEBPACK_IMPORTED_MODULE_14__pages_add_slave_server_add_slave_server__["a" /* AddSlaveServerPage */],
                __WEBPACK_IMPORTED_MODULE_15__pages_slave_preseed_slave_preseed__["a" /* SlavePreseedPage */],
                __WEBPACK_IMPORTED_MODULE_16__pages_slave_hypervisor_selection_slave_hypervisor_selection__["a" /* SlaveHypervisorSelectionPage */],
                __WEBPACK_IMPORTED_MODULE_17__pages_slave_distribution_selection_slave_distribution_selection__["a" /* SlaveDistributionSelectionPage */],
                __WEBPACK_IMPORTED_MODULE_18__pages_tabs_tabs__["a" /* TabsPage */]
            ],
            providers: [
                __WEBPACK_IMPORTED_MODULE_19__ionic_native_status_bar__["a" /* StatusBar */],
                __WEBPACK_IMPORTED_MODULE_20__ionic_native_splash_screen__["a" /* SplashScreen */],
                { provide: __WEBPACK_IMPORTED_MODULE_0__angular_core__["u" /* ErrorHandler */], useClass: __WEBPACK_IMPORTED_MODULE_2_ionic_angular__["c" /* IonicErrorHandler */] },
                __WEBPACK_IMPORTED_MODULE_21__providers_auth_service_auth_service__["a" /* AuthServiceProvider */]
            ]
        })
    ], AppModule);
    return AppModule;
}());

//# sourceMappingURL=app.module.js.map

/***/ }),

/***/ 283:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MyApp; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__ionic_native_status_bar__ = __webpack_require__(210);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__ionic_native_splash_screen__ = __webpack_require__(213);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__pages_welcome_welcome__ = __webpack_require__(112);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var MyApp = (function () {
    function MyApp(platform, statusBar, splashScreen) {
        this.rootPage = __WEBPACK_IMPORTED_MODULE_4__pages_welcome_welcome__["a" /* WelcomePage */];
        platform.ready().then(function () {
            // Okay, so the platform is ready and our plugins are available.
            // Here you can do any higher level native things you might need.
            statusBar.styleDefault();
            splashScreen.hide();
        });
    }
    MyApp = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/app/app.html"*/'<ion-nav [root]="rootPage"></ion-nav>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/app/app.html"*/
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["i" /* Platform */], __WEBPACK_IMPORTED_MODULE_2__ionic_native_status_bar__["a" /* StatusBar */], __WEBPACK_IMPORTED_MODULE_3__ionic_native_splash_screen__["a" /* SplashScreen */]])
    ], MyApp);
    return MyApp;
}());

//# sourceMappingURL=app.component.js.map

/***/ }),

/***/ 42:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return DashboardPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__add_master_server_add_master_server__ = __webpack_require__(104);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__update_master_update_master__ = __webpack_require__(105);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__show_master_detail_show_master_detail__ = __webpack_require__(52);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






/**
 * Generated class for the DashboardPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var DashboardPage = (function () {
    function DashboardPage(navCtrl, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPostData = { 'token_id': '', 'user_id': '' };
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userTokenExpire = localStorage.getItem('token_expiration');
        this.loadVms();
    }
    DashboardPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad DashboardPage');
    };
    DashboardPage.prototype.loadVms = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'master_server_list');
        if (logRes['error'] === false) {
            this.vms = logRes['results']['list'];
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    DashboardPage.prototype.updateMaster = function (vmID) {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_4__update_master_update_master__["a" /* UpdateMasterPage */], { 'vmID': vmID });
    };
    DashboardPage.prototype.showMasterDetail = function (vmID) {
        localStorage.setItem('vmID', vmID);
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_5__show_master_detail_show_master_detail__["a" /* ShowMasterDetailPage */]);
    };
    DashboardPage.prototype.createMasterServer = function () {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_3__add_master_server_add_master_server__["a" /* AddMasterServerPage */]);
    };
    DashboardPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-dashboard',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/dashboard/dashboard.html"*/'<!--\n  Generated template for the DashboardPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n    <ion-navbar>\n        <ion-title>Dashboard</ion-title>\n    </ion-navbar>\n\n</ion-header>\n\n<ion-content class="card-background-page">\n    <div class="btn-add-master-container">\n        <button ion-button icon-right (click)="createMasterServer()">\n            New master server\n            <ion-icon name="add-circle"></ion-icon>\n        </button>\n    </div>\n\n    <ion-card *ngFor="let item of vms">\n        <img src="../../assets/imgs/debain_background.jpg"/>\n        <div class="card-title">\n            {{item[\'name\']}}\n        </div>\n        <div class="card-subtitle">\n            {{item[\'ip\']}}\n        </div>\n        <div class="card-info-btn">\n            <button ion-button icon-only color="light" (click)="showMasterDetail(item[\'master_id\'])">\n                <ion-icon name="ios-information-circle-outline"></ion-icon>\n            </button>\n        </div>\n        <div class="card-manage-btn">\n            <button ion-button icon-only color="light" (click)="updateMaster(item[\'master_id\'])">\n                <ion-icon name="ios-cog-outline"></ion-icon>\n            </button>\n        </div>\n    </ion-card>\n\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/dashboard/dashboard.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]])
    ], DashboardPage);
    return DashboardPage;
}());

//# sourceMappingURL=dashboard.js.map

/***/ }),

/***/ 52:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ShowMasterDetailPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__show_slave_detail_show_slave_detail__ = __webpack_require__(106);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__slave_preseed_slave_preseed__ = __webpack_require__(107);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__slave_hypervisor_selection_slave_hypervisor_selection__ = __webpack_require__(108);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






/**
 * Generated class for the ShowMasterDetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var ShowMasterDetailPage = (function () {
    function ShowMasterDetailPage(navCtrl, navParams, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.navParams = navParams;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userPostData = {
            'token_id': '',
            'user_id': '',
            'master_id': '',
        };
        this.userPostData.token_id = localStorage.getItem('token_id');
        this.userPostData.user_id = localStorage.getItem('user_id');
        this.userPostData.master_id = localStorage.getItem('vmID');
        this.loadMasterDetails();
    }
    ShowMasterDetailPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad ShowMasterDetailPage');
    };
    ShowMasterDetailPage.prototype.loadMasterDetails = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'master_server_details');
        if (logRes['error'] === false) {
            (logRes['results'] == null) ? this.vm_detail = this.generateDefaultMasterDetail() : this.vm_detail = logRes['results'];
            loading.dismiss();
            this.loadMasterSlaves();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    ShowMasterDetailPage.prototype.loadMasterSlaves = function () {
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userPostData, 'slave_server_list');
        if (logRes['error'] === false) {
            this.vm_slaves = logRes['results']['list'];
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    ShowMasterDetailPage.prototype.showSlaveDetail = function (slaveID) {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_3__show_slave_detail_show_slave_detail__["a" /* ShowSlaveDetailPage */], { 'slaveID': slaveID });
    };
    ShowMasterDetailPage.prototype.createSalveForMaster = function () {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_5__slave_hypervisor_selection_slave_hypervisor_selection__["a" /* SlaveHypervisorSelectionPage */], { 'slaveID': this.userPostData.master_id });
    };
    ShowMasterDetailPage.prototype.showSlavePreseed = function (slaveID, distributionID) {
        console.log(slaveID);
        console.log(distributionID);
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_4__slave_preseed_slave_preseed__["a" /* SlavePreseedPage */], { 'slaveID': slaveID, 'distributionID': distributionID });
    };
    ShowMasterDetailPage.prototype.generateDefaultMasterDetail = function () {
        return {
            'name': 'VM NAME',
            'ip': 'VM IP',
            'mac': 'VM MAC',
            'gateway': 'VM GATEWAY',
            'memory': 'VM MEMORY',
            'storage': 'VM STORAGE'
        };
    };
    ShowMasterDetailPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-show-master-detail',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/show-master-detail/show-master-detail.html"*/'<!--\n  Generated template for the ShowMasterDetailPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-header>\n\n    <ion-navbar>\n        <ion-title>Master Server Info</ion-title>\n    </ion-navbar>\n\n</ion-header>\n\n<ion-content class="card-background-page">\n    <!-- MASTER DETAILS -->\n    <ion-card>\n        <ion-card-header>\n            {{vm_detail[\'name\']}}\n        </ion-card-header>\n\n        <ion-list class="card-subtitle">\n            <div ion-item>\n                <ion-icon name="at" item-start></ion-icon>\n                IP - {{vm_detail[\'ip\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="finger-print" item-start></ion-icon>\n                Mac - {{vm_detail[\'mac\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="eye" item-start></ion-icon>\n                Gateway - {{vm_detail[\'gateway\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="crop" item-start></ion-icon>\n                RAM - {{vm_detail[\'memory\']}} Mo\n            </div>\n\n            <div ion-item>\n                <ion-icon name="disc" item-start></ion-icon>\n                Storage - {{vm_detail[\'storage\']}} Mo\n            </div>\n        </ion-list>\n    </ion-card>\n\n    <!-- CREATE SLAVE BUTTON -->\n    <div class="btn-add-slave-container">\n        <button ion-button icon-right (click)="createSalveForMaster()">\n            Create a VM\n            <ion-icon name="add-circle"></ion-icon>\n        </button>\n    </div>\n\n    <!-- SLAVES LIST -->\n    <ion-card *ngFor="let item of vm_slaves">\n        <ion-list class="card-subtitle">\n            <div ion-item>\n                <ion-icon name="globe" item-start></ion-icon>\n                Name - {{item[\'name\']}}\n            </div>\n\n            <div ion-item>\n                <ion-icon name="finger-print" item-start></ion-icon>\n                IP - {{item[\'ip\']}}\n            </div>\n            <div ion-item>\n                <button ion-button (click)="showSlaveDetail(item[\'slave_id\'])">\n                    <ion-icon item-start name="ios-information-circle-outline"></ion-icon>\n                    Details\n                </button>\n\n                <button ion-button icon-right (click)="showSlavePreseed(item[\'slave_id\'], item[\'distribution_id\'])">\n                    Preseeds\n                    <ion-icon name="ios-cog-outline"></ion-icon>\n                </button>\n            </div>\n        </ion-list>\n    </ion-card>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/show-master-detail/show-master-detail.html"*/,
        }),
        __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */]) === "function" && _a || Object, typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["h" /* NavParams */]) === "function" && _b || Object, typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */]) === "function" && _c || Object, typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */]) === "function" && _d || Object, typeof (_e = typeof __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]) === "function" && _e || Object])
    ], ShowMasterDetailPage);
    return ShowMasterDetailPage;
    var _a, _b, _c, _d, _e;
}());

//# sourceMappingURL=show-master-detail.js.map

/***/ }),

/***/ 53:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LoginPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__tabs_tabs__ = __webpack_require__(169);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__signup_signup__ = __webpack_require__(54);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var LoginPage = (function () {
    function LoginPage(navCtrl, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userData = { 'username': '', 'password': '' };
    }
    LoginPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad LoginPage');
    };
    LoginPage.prototype.login = function () {
        var _this = this;
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        var logRes = this.authServiceProvider.postData(this.userData, 'login');
        if (logRes['error'] === false) {
            loading.present();
            localStorage.setItem('user_id', logRes['results']['user_id']);
            localStorage.setItem('token_id', logRes['results']['token_id']);
            localStorage.setItem('token_expiration', logRes['results']['expiration']);
            loading.onDidDismiss(function () {
                _this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_3__tabs_tabs__["a" /* TabsPage */]);
            });
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    LoginPage.prototype.signup = function () {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_4__signup_signup__["a" /* SignupPage */]);
    };
    LoginPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-login',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/login/login.html"*/'<!--\n  Generated template for the LoginPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-content padding>\n    <ion-list>\n\n        <ion-item>\n            <ion-label fixed>Username*</ion-label>\n            <ion-input type="text" value="" [(ngModel)]="userData.username"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-label fixed>Password*</ion-label>\n            <ion-input type="password" [(ngModel)]="userData.password"></ion-input>\n        </ion-item>\n\n    </ion-list>\n    <div padding>\n        <button ion-button full round color="primary" (click)="login()">Log in</button>\n        <button ion-button full round clear color="primary" (click)="signup()">Create an account</button>\n    </div>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/login/login.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]])
    ], LoginPage);
    return LoginPage;
}());

//# sourceMappingURL=login.js.map

/***/ }),

/***/ 54:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return SignupPage; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_ionic_angular__ = __webpack_require__(10);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__login_login__ = __webpack_require__(53);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




/**
 * Generated class for the SignupPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
var SignupPage = (function () {
    function SignupPage(navCtrl, authServiceProvider, loadingCtrl, toastCtrl) {
        this.navCtrl = navCtrl;
        this.authServiceProvider = authServiceProvider;
        this.loadingCtrl = loadingCtrl;
        this.toastCtrl = toastCtrl;
        this.userData = { 'username': '', 'password': '', 'email': '', 'phonenumber': '' };
    }
    SignupPage.prototype.ionViewDidLoad = function () {
        console.log('ionViewDidLoad SignupPage');
    };
    SignupPage.prototype.signup = function () {
        var _this = this;
        var loading = this.loadingCtrl.create({
            content: 'Please wait...'
        });
        loading.present();
        var logRes = this.authServiceProvider.postData(this.userData, 'register');
        if (logRes['error'] === false) {
            this.reponseData = logRes['results'];
            localStorage.setItem('userData', JSON.stringify(this.userData));
            loading.onDidDismiss(function () {
                _this.login();
            });
            loading.dismiss();
        }
        else {
            var toast = this.toastCtrl.create({
                message: logRes['message'],
                duration: 3000,
                position: 'bottom'
            });
            loading.dismiss();
            toast.present();
        }
    };
    SignupPage.prototype.login = function () {
        this.navCtrl.push(__WEBPACK_IMPORTED_MODULE_3__login_login__["a" /* LoginPage */]);
    };
    SignupPage = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["m" /* Component */])({
            selector: 'page-signup',template:/*ion-inline-start:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/signup/signup.html"*/'<!--\n  Generated template for the SignupPage page.\n\n  See http://ionicframework.com/docs/components/#navigation for more info on\n  Ionic pages and navigation.\n-->\n<ion-content padding>\n    <ion-list>\n        <ion-item>\n            <ion-label fixed>Username*</ion-label>\n            <ion-input type="text" value="" [(ngModel)]="userData.username"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-label fixed>Password*</ion-label>\n            <ion-input type="password" minlength="4" [(ngModel)]="userData.password"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-label fixed>Email*</ion-label>\n            <ion-input type="email" value="" [(ngModel)]="userData.email"></ion-input>\n        </ion-item>\n\n        <ion-item>\n            <ion-label fixed>Phone</ion-label>\n            <ion-input type="phone" value="" placeholder="(optional +33...)" [(ngModel)]="userData.phonenumber"></ion-input>\n        </ion-item>\n\n    </ion-list>\n    <div padding>\n        <button ion-button full round color="primary" (click)="signup()">Register</button>\n        <button ion-button full round clear color="primary" (click)="login()">Already an account ?</button>\n    </div>\n</ion-content>\n'/*ion-inline-end:"/Users/henri/Desktop/CCA/OpenVirtua/src/pages/signup/signup.html"*/,
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1_ionic_angular__["g" /* NavController */], __WEBPACK_IMPORTED_MODULE_2__providers_auth_service_auth_service__["a" /* AuthServiceProvider */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["f" /* LoadingController */], __WEBPACK_IMPORTED_MODULE_1_ionic_angular__["j" /* ToastController */]])
    ], SignupPage);
    return SignupPage;
}());

//# sourceMappingURL=signup.js.map

/***/ })

},[214]);
//# sourceMappingURL=main.js.map