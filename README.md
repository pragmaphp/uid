# PragmaPHP Uid

Unique ID generation based on [ulid/spec](https://github.com/ulid/spec)

[![Build Status](https://api.travis-ci.com/pragmaphp/uid.svg)](https://travis-ci.com/pragmaphp/uid)

## Usage

```
\PragmaPHP\Uid\Uid::generate();
```

## Specification

```
 01AN4Z07BY      79KA1307SR9X4MV3

|----------|    |----------------|
 Timestamp          Randomness
   48bits             80bits
```

### Components

**Timestamp**
- 48 bit integer
- UNIX-time in milliseconds
- Won't run out of space 'til the year 10889 AD.

**Randomness**
- 80 bits
- Cryptographically secure source of randomness, if possible

### Sorting

The left-most character must be sorted first, and the right-most character sorted last (lexical order). The default ASCII character set must be used. Within the same millisecond, sort order is not guaranteed

### Canonical String Representation

```
ttttttttttrrrrrrrrrrrrrrrr

where
t is Timestamp (10 characters)
r is Randomness (16 characters)
```

#### Encoding

Crockford's Base32 is used as shown. This alphabet excludes the letters I, L, O, and U to avoid confusion and abuse.

```
0123456789ABCDEFGHJKMNPQRSTVWXYZ
``` 