import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DesktopreviewComponent } from './desktopreview.component';

describe('DesktopreviewComponent', () => {
  let component: DesktopreviewComponent;
  let fixture: ComponentFixture<DesktopreviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DesktopreviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DesktopreviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
