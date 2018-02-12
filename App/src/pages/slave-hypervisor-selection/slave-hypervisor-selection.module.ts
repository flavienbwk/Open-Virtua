import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SlaveHypervisorSelectionPage } from './slave-hypervisor-selection';

@NgModule({
  declarations: [
    SlaveHypervisorSelectionPage,
  ],
  imports: [
    IonicPageModule.forChild(SlaveHypervisorSelectionPage),
  ],
})
export class SlaveHypervisorSelectionPageModule {}
