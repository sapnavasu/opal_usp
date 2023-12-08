import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ScsiteauditComponent } from './scsiteaudit.component';

describe('ScsiteauditComponent', () => {
  let component: ScsiteauditComponent;
  let fixture: ComponentFixture<ScsiteauditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ScsiteauditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ScsiteauditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
