import Example from './modules/example';

var example = new Example();
example.run();
example.lodash();


import { greet, anotherGreet } from './modules/greet';

console.log( greet() );
console.log( anotherGreet() );