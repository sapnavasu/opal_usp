import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ConfigurebymoduleComponent } from './configurebymodule.component';

describe('ConfigurebymoduleComponent', () => {
  let component: ConfigurebymoduleComponent;
  let fixture: ComponentFixture<ConfigurebymoduleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ConfigurebymoduleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ConfigurebymoduleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
