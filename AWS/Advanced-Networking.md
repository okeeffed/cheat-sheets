# Advanced Networking

## IPv4 and Subnetting

255.255.255.255

The `/8, /16, /24, /32` refers to how many bits are being masked. If it is `/17` for example, 17 bits are masked with `2^1` subnets and `2^15 - 2` available addresses with one address for the host and one for the network.

**MPLS (Multi-Protocol Label Switching)**
Method by which a direct link between two or more sites is simulated by efficiently directing traffic over multiple points.

**Addresses in 10.0.0.0/16 VPC reserved for AWS**
10.0.0.0, 10.0.0.1, 10.0.0.2, 10.0.0.3 and 10.0.0.255.

**FEC (Forward Equivalency Class)**
A label applied to packets to allow routes to immediately know where to route them.

**BGP**
AWS preferred Routing Protocol to route between multiple Autonomous Systems.

**Encryption Keys that require both public and private**
Public-Key encryption (or asymmetric key encryption).

## VPN Fundamentals

What is a VPN?

Virtual Private Network that exists to allow traffic to move securely and confidentially.

There are two primary types:

1. Site-to-site: Two or more sites are connected without any software on the client machines. MPLS can be used to create this.
2. Client-to-site: Client has software installed that allows it to communicate with the site. Typically used for remote workers.

### Keys

1. Symmetric-key encryption: All parties share the same key to encrypt and decrypt a message.
2. Public-key encrytion (asymmetric): Each party has a public-private key pair. One computer uses its private key to encrypt a message and the other uses its public key to decrypt.

### Auth Key Exchange

1. RSA:
	- Asymmetric.
	- Used primarily in key exchange in other protocols, such as SSL. RSA is used to encrypt an AES key exchange.
	- 2048 bit encryption or higher is considered secure as 1024 has been theorized to be cracked by NSA.
2. Diffie-Hellman
	- Faster than RSA
	- Used by AWS
	- Provides PFS

3. PFS (Perfect Forward Secrecy)
	- Means that the compromise of session does not endanger others. New keys are created for every session.
