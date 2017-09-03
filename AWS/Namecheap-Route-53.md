# Namecheap to Route 53

## Validating Google Mail

Change the Simple DNS from Namecheap and point it to the custom name servers at AWS.

On AWS, ensure that you head onto Route 53 and create a new set (forget the name right now) and take the NS data it gives you and post it into the DNS settings in Namecheap. Once that is done, set up Route 53 similar to how you set up everything on AWS. Give the URL to the S3 site as an alias record and set up the MX records as need be.

