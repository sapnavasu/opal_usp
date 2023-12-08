import { trigger, state, style, transition,
    animate, group, query, stagger, keyframes
} from '@angular/animations';

export const SlideInOutAnimation = [
    trigger('slideInOut', [
        state('in', style({
            'max-height': '500px', 'opacity': '1', 'visibility': 'visible','position':'relative','z-index':'2'
        })),
        state('out', style({
            'max-height': '0px', 'opacity': '0', 'visibility': 'hidden','position':'relative','z-index':'2'
        })),
        transition('in => out', [group([
            animate('300ms ease-in-out', style({
                'opacity': '0'
            })),
            animate('300ms ease-in-out', style({
                'max-height': '0px'
            })),
            animate('300ms ease-in-out', style({
                'visibility': 'hidden'
            }))
        ]
        )]),
        transition('out => in', [group([
            animate('300ms ease-in-out', style({
                'visibility': 'visible'
            })),
            animate('300ms ease-in-out', style({
                'max-height': '500px'
            })),
            animate('300ms ease-in-out', style({
                'opacity': '1'
            }))
        ]
        )])
    ]),
]