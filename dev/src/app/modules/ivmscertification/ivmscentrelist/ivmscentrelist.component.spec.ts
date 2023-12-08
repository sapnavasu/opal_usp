import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmscentrelistComponent } from './ivmscentrelist.component';

describe('IvmscentrelistComponent', () => {
  let component: IvmscentrelistComponent;
  let fixture: ComponentFixture<IvmscentrelistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmscentrelistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmscentrelistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
