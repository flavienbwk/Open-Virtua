import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { UpdateMasterPage } from './update-master';

@NgModule({
  declarations: [
    UpdateMasterPage,
  ],
  imports: [
    IonicPageModule.forChild(UpdateMasterPage),
  ],
})
export class UpdateMasterPageModule {}
