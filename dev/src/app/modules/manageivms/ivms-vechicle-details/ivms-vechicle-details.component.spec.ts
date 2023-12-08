import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsVechicleDetailsComponent } from './ivms-vechicle-details.component';

describe('IvmsVechicleDetailsComponent', () => {
  let component: IvmsVechicleDetailsComponent;
  let fixture: ComponentFixture<IvmsVechicleDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsVechicleDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsVechicleDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
