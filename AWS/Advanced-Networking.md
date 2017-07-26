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

### Message intergrity

If intercepted, the message could be modified.

To verify authenticity you have the following options:

1. MD5 (Message Digest)
	- MD5 is broken, don't use for production environments.
2. SHA (Secure Hash Algorithm)
	- SHA-1: 160-bit hash similar to MD5. Also considered insecure.
	- SHA-2: SHA-2 includes SHA-256 and SHA-512.
	- SHA-3: SHA-3 is the only member of the SHA family not created by the NSA.

### Confidentiality

1. Triple DES (3DES)
	- Three symmetric keys with 56 bits each.
	- Slowly being phased out in favour of stronger encrytion keys.
2. Blowfish
	- Fast algorithm.
	- Secure.
	- Blocks of 64 bits encrypted individually.
3. Twofish
	- Successor to Blowfish
	- Up to 256 bit in length
	- One of the faster algorithms
4. AES
	- Standard for US Gov and many other organizations.
	- Symmetric key algorithm.
	- Uses 128, 192 or 256 bit encryption.
	- Widely regarded as the de-facto standard for message encryption.
	- Probably what is used in many instances.

### VPN Protocols

1. PPP
	- Point-to-point protocol used to encrypt traffic within a tunnel.
	- PPP is Layer 2 protocol.
2. PPTP
	- Point-to-point tunnel protocol.
	- Establishes GRE tunnel. Then uses PPP to encrypt and authenticate the traffic.
	- Uses simple password auth.
3. L2TP
	- Layer 2 transfer protocol.
	- Created by Microsoft and Cisco to combine LTP and PPTP to create a more secure protocol using IPSec.
4. IKEv2
	- Internet Key Exchange version 2
	- Used with IPSec and was created by Microsoft and Cisco to be faster than L2TP.


