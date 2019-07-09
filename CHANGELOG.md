# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v0.11.0]
### Added
- Add `webpatser/laravel-uuid` package dependencies
- Add helper function `httpStatusCode`
- New exceptions:
    - `AccessDeniedHttpException`
    - `BadRequestHttpException`
    - `ConflictHttpException`
    - `NotAcceptableHttpException`
    - `NotFoundHttpException`
    - `ServiceUnavailableHttpException`
    - `UnauthorizedHttpException`
    - `UnprocessableEntityHttpException`
    - `UnsupportedMediaTypeHttpException`
- New middleware:
    - `CheckContentTypeHttpHeader`
    - `CheckForAnyScope`
    - `CheckScopes`
- New `UuidModel` traits

### Changed
- Change `CheckAcceptHttpHeader` middleware

### Removed


[v0.11.0]: https://github.com/consigliere/Signature/releases/tag/v0.11.0
