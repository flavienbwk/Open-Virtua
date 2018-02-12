import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AddMasterServerPage } from './add-master-server';

@NgModule({
  declarations: [
    AddMasterServerPage,
  ],
  imports: [
    IonicPageModule.forChild(AddMasterServerPage),
  ],
})
export class AddMasterServerPageModule {}
