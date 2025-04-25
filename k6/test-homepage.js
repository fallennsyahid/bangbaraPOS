import http from 'k6/http';
import { check, sleep } from 'k6';

export let options = {
    vus: 5, // Number of virtual users
    duration: '30s', // Duration of the test
}

export default function () {
    let res = http.get('http://localhost:8000/');

    check(res, {
        'status was 200': (r) => r.status === 200,
        'response time < 500ms': (r) => r.timings.duration < 500,
    });

    sleep(1); // Sleep for 1 second between requests
}