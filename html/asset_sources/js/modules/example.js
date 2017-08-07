import _ from 'lodash';

class Example {
    constructor() {
        this.test = 1;
    }

    run() {
        let double = [1,2,3].map((num) => num * 2);
        console.log(double, this.test);
    }

    lodash() {
        console.log( _.join(['Hello', 'webpack', 'Test'], ' ') );
    }
}

export default Example;
