import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PortalbatchmngmntComponent } from './portalbatchmngmnt.component';

describe('PortalbatchmngmntComponent', () => {
  let component: PortalbatchmngmntComponent;
  let fixture: ComponentFixture<PortalbatchmngmntComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PortalbatchmngmntComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PortalbatchmngmntComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
