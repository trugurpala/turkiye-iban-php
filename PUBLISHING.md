# Publishing

The PHP client has a verified GitHub release, but the Packagist index entry is
not yet verified. Do not describe `composer require trugurpala/turkiye-iban`
as available until a clean Composer install from Packagist has been checked.

The release workflow runs the package checks on every push. It creates and
uploads a clean source archive only when a `v*` version tag is pushed; the
publishing job owns the minimum required `contents: write` permission.

## Release checklist

1. Run `composer test` on the supported PHP matrix.
2. Run `composer analyse` at PHPStan level 8.
3. Run `composer run prepare-assets` and verify the pinned data checksums.
4. Create a SemVer `v*` tag and let the release workflow build the archive.
5. Verify the GitHub release asset and checksum.
6. Submit the repository to Packagist and enable its GitHub webhook.
7. Verify a clean `composer require trugurpala/turkiye-iban` installation.

The package uses no runtime network request. See the [main publication status](https://github.com/trugurpala/turkiye-iban/blob/main/docs/PACKAGE_INDEX_PUBLICATION.md)
and [release history](CHANGELOG.md).
