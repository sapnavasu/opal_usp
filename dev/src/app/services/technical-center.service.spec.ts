import { TestBed } from '@angular/core/testing';

import { TechnicalCenterService } from './technical-center.service';

describe('TechnicalCenterService', () => {
  let service: TechnicalCenterService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TechnicalCenterService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
