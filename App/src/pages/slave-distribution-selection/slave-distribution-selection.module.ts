import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SlaveDistributionSelectionPage } from './slave-distribution-selection';

@NgModule({
  declarations: [
    SlaveDistributionSelectionPage,
  ],
  imports: [
    IonicPageModule.forChild(SlaveDistributionSelectionPage),
  ],
})
export class SlaveDistributionSelectionPageModule {}
