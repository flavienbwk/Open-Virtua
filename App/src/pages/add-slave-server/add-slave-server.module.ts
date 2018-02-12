import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AddSlaveServerPage } from './add-slave-server';

@NgModule({
  declarations: [
    AddSlaveServerPage,
  ],
  imports: [
    IonicPageModule.forChild(AddSlaveServerPage),
  ],
})
export class AddSlaveServerPageModule {}
