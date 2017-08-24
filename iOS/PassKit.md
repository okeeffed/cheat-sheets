# PassKit

## Adding the certificate

Head to the iOS dev portal and add the appropriate certificate.

You may need to open Keychain access to generate a new key using `Keychain Access > Certificate Assistant > Req Cert from Cert Auth` and generate a new cert. This cert will be used to generate what you need to import into Keychain Access from the dev portal.

Once created, download the certificate and export it as .p12 to the server which hosts `node-passbook`. You may need to global install as well `npm install -g passbook` to then use `node-passbook prepare-keys -p keys` to convert .p12 to .pem.


