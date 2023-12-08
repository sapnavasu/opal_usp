import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmsViewComponent } from './ivms-view.component';

describe('IvmsViewComponent', () => {
  let component: IvmsViewComponent;
  let fixture: ComponentFixture<IvmsViewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmsViewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmsViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
