import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FileuploadwrapperComponent } from './fileuploadwrapper.component';

describe('FileuploadwrapperComponent', () => {
  let component: FileuploadwrapperComponent;
  let fixture: ComponentFixture<FileuploadwrapperComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FileuploadwrapperComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FileuploadwrapperComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
