# AWS Node SDK

<!-- TOC -->

*   [AWS Node SDK](#aws-node-sdk)
    *   [Loading Credentials in Node.js from Environment Variables](#loading-credentials-in-nodejs-from-environment-variables)
    *   [Example use in a task runner - get EC2 Details back](#example-use-in-a-task-runner---get-ec2-details-back)

<!-- /TOC -->

## Loading Credentials in Node.js from Environment Variables

*   AWS_ACCESS_KEY_ID
*   AWS_SECRET_ACCESS_KEY
*   AWS_SESSION_TOKEN (optional)

These can be set into your ENV variables.

## Example use in a task runner - get EC2 Details back

```javascript
var fs = require('fs');
const util = require('util');
var dotenv = require('dotenv');
var envConfig = dotenv.parse(fs.readFileSync('.env'));
for (var k in envConfig) {
    process.env[k] = envConfig[k];
}

var gulp = require('gulp');

// Load the SDK for JavaScript
var AWS = require('aws-sdk');

var params = {
    InstanceIds: [process.env.EC2_INSTANCE_ID]
};

/* Get EC2 Details */
gulp.task('info', function() {
    AWS.config = {
        accessKeyId: process.env.AWS_ACCESS_KEY,
        secretAccessKey: process.env.AWS_SECRET_KEY,
        region: process.env.AWS_REGION
    };

    // Create EC2 service object
    ec2 = new AWS.EC2({ apiVersion: '2016-11-15' });

    // Call EC2 to retrieve the policy for selected bucket
    ec2.describeInstances(params, function(err, data) {
        if (err) {
            console.log('Error', err.stack);
        } else {
            console.log('Success', util.inspect(data, { depth: 6 }));
        }
    });
});
```
