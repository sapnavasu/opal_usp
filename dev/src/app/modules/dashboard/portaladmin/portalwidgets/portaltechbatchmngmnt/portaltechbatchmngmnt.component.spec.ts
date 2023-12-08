import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PortaltechbatchmngmntComponent } from './portaltechbatchmngmnt.component';

describe('PortaltechbatchmngmntComponent', () => {
  let component: PortaltechbatchmngmntComponent;
  let fixture: ComponentFixture<PortaltechbatchmngmntComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PortaltechbatchmngmntComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PortaltechbatchmngmntComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
