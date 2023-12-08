import { TestBed } from '@angular/core/testing';

import { CenterCertificationService } from './center-certification.service';

describe('CenterCertificationService', () => {
  let service: CenterCertificationService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CenterCertificationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
