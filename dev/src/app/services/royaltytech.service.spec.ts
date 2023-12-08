import { TestBed } from '@angular/core/testing';

import { RoyaltytechService } from './royaltytech.service';

describe('RoyaltytechService', () => {
  let service: RoyaltytechService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RoyaltytechService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
