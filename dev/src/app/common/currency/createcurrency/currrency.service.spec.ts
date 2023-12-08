import { TestBed, inject } from '@angular/core/testing';

import { CurrrencyService } from './currrency.service';

describe('CurrrencyService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [CurrrencyService]
    });
  });

  it('should be created', inject([CurrrencyService], (service: CurrrencyService) => {
    expect(service).toBeTruthy();
  }));
});
