import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CollaboratefiltercardComponent } from './collaboratefiltercard.component';

describe('CollaboratefiltercardComponent', () => {
  let component: CollaboratefiltercardComponent;
  let fixture: ComponentFixture<CollaboratefiltercardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CollaboratefiltercardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CollaboratefiltercardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
