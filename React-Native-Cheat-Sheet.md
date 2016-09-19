# React Native Help Sheet

## RNHELP-1: Debugger

To stop the React Native dev menu from showing up, ensure that you put into `Release`

## RNHELP-2: (void) casting for iOS10

```
(void)SecRandomCopyBytes(kSecRandomDefault, keyBytes.length, keyBytes.mutableBytes);
(void)SecRandomCopyBytes(kSecRandomDefault, sizeof(uint32_t), (uint8_t *)mask_key);
```

## RNHELP-3: Code Signing

If disallowed for build, turn off automatic signing, clean, close the project, up back up and then turn automatic signing back on.
