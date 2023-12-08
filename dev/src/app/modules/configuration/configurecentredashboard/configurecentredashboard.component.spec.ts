import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ConfigurecentredashboardComponent } from './configurecentredashboard.component';

describe('ConfigurecentredashboardComponent', () => {
  let component: ConfigurecentredashboardComponent;
  let fixture: ComponentFixture<ConfigurecentredashboardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ConfigurecentredashboardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ConfigurecentredashboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
