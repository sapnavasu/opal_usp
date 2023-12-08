import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocumentstabComponent } from './documentstab.component';

describe('DocumentstabComponent', () => {
  let component: DocumentstabComponent;
  let fixture: ComponentFixture<DocumentstabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocumentstabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocumentstabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
