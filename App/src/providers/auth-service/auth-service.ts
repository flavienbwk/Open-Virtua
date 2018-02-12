import {HttpClient, HttpHeaders} from '@angular/common/http'; import {Injectable} from '@angular/core'; let 
API_ACCES_KEY = 'x-ov-api-key'; let API_ACCESS_VALUE = '1c392287e4ee980d0f5d5ed2a91e34xxxxxxxxxx'; let API_URLS 
= {
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
    'slave_preseed_list':'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/preseeds',
    'slave_preseed_add':'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/preseeds/add',
    'slave_preseed_remove':'https://flavien.berwick.fr/projects/etna/open-virtua/api/slave/preseeds/remove',
    'hypervisors_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/hypervisor/list',
    'distributions_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/hypervisor/distributions',
    'preseeds_list': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/distributions/preseeds',
    'preseeds_add': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/distributions/preseed/create',
    'preseeds_remove': 'https://flavien.berwick.fr/projects/etna/open-virtua/api/distributions/preseed/remove'
};
/*
  Generated class for the AuthServiceProvider provider.
  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI. */ @Injectable() export class AuthServiceProvider {
    constructor(public http: HttpClient) {
    }
    postData(credentials, urlIndex) {
        let xml = new XMLHttpRequest();
        xml.open('POST', API_URLS[urlIndex], false);
        xml.setRequestHeader(API_ACCES_KEY, API_ACCESS_VALUE);
        xml.send(this.formatCredentials(credentials));
        return JSON.parse(xml.response);
    }
    private formatCredentials(credentials) {
        let data = new FormData();
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
        if(credentials['slave_id'] != null) {
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
    }
}
