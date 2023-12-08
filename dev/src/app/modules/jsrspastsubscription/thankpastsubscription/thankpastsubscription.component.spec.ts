import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ThankpastsubscriptionComponent } from './thankpastsubscription.component';

describe('ThankpastsubscriptionComponent', () => {
  let component: ThankpastsubscriptionComponent;
  let fixture: ComponentFixture<ThankpastsubscriptionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ThankpastsubscriptionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ThankpastsubscriptionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
