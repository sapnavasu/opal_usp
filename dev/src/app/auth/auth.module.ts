import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FlexLayoutModule } from '@angular/flex-layout';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatCheckboxModule } from '@angular/material/checkbox';
import { MatIconModule } from '@angular/material/icon';
import { MatInputModule } from '@angular/material/input';
import { MatRadioModule } from '@angular/material/radio';
import { HttpLoaderFactory, SharedModule } from '@app/@shared';
import { Encrypt } from '@app/common/class/encrypt';
import { RestrictkeyboardDirective } from '@app/common/directives/restrictkeyboard.directive';
//import { I18nModule } from '@app/i18n';
// import { SharedModule } from '@shared';
import { MaterialModule } from '@app/material.module';
import { RemoteService } from '@app/remote.service';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { MatProgressButtonsModule } from 'mat-progress-buttons';
import { RecaptchaV3Module, ReCaptchaV3Service, RECAPTCHA_V3_SITE_KEY } from 'ng-recaptcha';
import { PopoverModule } from 'ngx-smart-popover';
import { PasswordDirective } from '../common/directives/password.directive';
import { AdminService } from './admin.service';
import { AuthRoutingModule } from './auth-routing.module';
import { AuthService } from './auth.service';
// import { LoginComponent } from './login.component';
import { LoginlayoutComponent } from './layouts/login/loginlayout.component';
import { LoginComponent } from './login.component';
import { ResetpasswordComponent } from './resetpassword/resetpassword.component';
import { SetpasswordComponent } from './setpassword/setpassword.component';
import { VirtualKeyboardComponent } from './virtual-keyboard/virtual-keyboard.component';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { RegistrationModule } from '@app/modules/registration/registration.module';
import { LearnerRegisterComponent } from '@app/modules/candidatemanagement/learner-register/learner-register.component';
import { LearnerfeedbackComponent } from '@app/learnerfeedback/learnerfeedback/learnerfeedback.component';
export function createTranslateLoader(http: HttpClient) {
  return new TranslateHttpLoader(http, './assets/i18n/login/', '.json');
}

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    TranslateModule,
    // SharedModule,
    FlexLayoutModule,
    MaterialModule,
   // I18nModule,
    AuthRoutingModule,
    MatProgressButtonsModule,
    HttpModule,
    RecaptchaV3Module,
    MatIconModule,
    MatCardModule,
    MatInputModule,
    MatRadioModule,
    MatCheckboxModule,
    MatButtonModule,
    FormsModule,
    FlexLayoutModule,
    SharedModule,
    PopoverModule,
    HttpClientModule,
    RegistrationModule,
    TranslateModule.forChild({
      loader: {
        provide: TranslateLoader,
        useFactory: createTranslateLoader,
        deps: [HttpClient]
      }
    }),
  
    
  ],
  declarations: [
    // LoginComponent,
    LoginlayoutComponent,
    PasswordDirective,
    LoginComponent,
    VirtualKeyboardComponent,
    RestrictkeyboardDirective,
    SetpasswordComponent,
    ResetpasswordComponent,
    LearnerfeedbackComponent
  ],
  exports: [
    PasswordDirective,
    VirtualKeyboardComponent,
    RestrictkeyboardDirective,
    SetpasswordComponent,
    ResetpasswordComponent,
    LearnerfeedbackComponent
  ],
  providers: [
    Encrypt,
    AdminService,
    RemoteService,
    AuthService,
    ReCaptchaV3Service,
    PasswordDirective,
    {
      provide: RECAPTCHA_V3_SITE_KEY,
      useValue: '6Ldec7AZAAAAADAY53ZvWGUq34shU6KR-R-uZrjD'
    },
  ]
})
export class AuthModule { }
