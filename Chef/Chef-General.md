# Chef General

## kitchen commands

Commands 				| Action
---						| ---
kitchen test 			| Tear down & restart full build
kitchen converge <id>	| Re-run recipes on already built VM
kitchen list			| List all the VM IDs
kitchen verify <id>		| Verify kitchen tests
kitchen login <id>		| Login to a local VM
kitchen destroy <id>	| Tear down instance
