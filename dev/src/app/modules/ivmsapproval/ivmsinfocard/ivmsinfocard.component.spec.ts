import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsinfocardComponent } from './ivmsinfocard.component';

describe('IvmsinfocardComponent', () => {
  let component: IvmsinfocardComponent;
  let fixture: ComponentFixture<IvmsinfocardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsinfocardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsinfocardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
