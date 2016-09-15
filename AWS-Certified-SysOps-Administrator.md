# AWS Certified SysOps Administrator

## AWSSYS-1: Monitoring, Metrics and Analysis

### ---- AWSSYS-1.1: CloudWatch Intro

It's a monitoring service to monitor the resources and what you run on AWS.

- EC2
- DynamoDB
- RDS DB instances etc
- Log files

__Host Level metrics__

1. CPU
2. Network
3. Disk
4. Status Check

RAM utilisation is a custom metric. You need to write Perl script for this.

By default, monitoring is 5 minutes. Detailed monitoring is 1 minute.

__How long are metrics stored?__

By default, for 2 weeks. You can use the `GetMetricsStatistics API` or third party tools to have access to data for longer.

You can retrieve data on terminated ELBs or instances for up to 2 weeks after it's termination.

__Metric Granularity__

Many default metrics are 1 minute, but it can be 3 or 5 too. The minimum that you can have it 1 minute.

__Alarms__

You can use this to monitor any metric. You can even use it for something like bills etc too.

You can also set the appropriate action and thresholds.

### ---- AWSSYS-1.2: EC2 Status Troubleshooting

On the console, you can see the status check from the EC2 panel.

There is a `System Status Check` or `Instance Status Check`.

__What is the difference?__

- System = physical host (the actual physical machine)
- Instance = VM itself

Difference troubleshooting for the different status checks.

__System status checks__

It will come up as an error if you have:

1. Loss of network connectivity
2. Loss of system power
3. Software issues on the physical host
4. Hardware issues on the physical host
5. Best way to resolve issues is to stop and then start the VM again

***
