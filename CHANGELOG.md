
Changelog
=========

3.0.2 (2024-10-29)
------------------

### Fixed

- Remove automatically setting of `navbar-light` class, since Bootstrap 5.2 the class is deprecated and conflicts with
  dark mode

3.0.1 (2024-01-26)
------------------

### Added

- Add compatibility with Contao 5.3

3.0.0 (2023-06-12)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.2.0...3.0.0)

### Changed

 - Use mvo/contao-group-widget instead of multi column wizard
 - Adjust for Bootstrap 5

2.2.2 (2022-04-20)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.1.4...2.2.0)

### Changed

 - Bump minimum PHP version to 7.4
 - Bump Symfony requirements to ^4.4 or ^5.4
 - Bump Contao requirements to ^4.9 or ^4.13
 - Changed coding standard


2.1.4 (2019-06-11)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.1.3...2.1.4)


### Enhanced

 - Add navClass if it's defined in the template (Feature of contao-bootstrap/templates) [#13](https://github.com/contao-bootstrap/navbar/issues/12)

### Fixed

 - Fix readme example [#13](https://github.com/contao-bootstrap/navbar/issues/13)

### Changed

 - Update travis configuration


2.1.3 (2018-08-27)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.1.2...2.1.3)

 - Fix broken target attribute which is already prerendered in the template.


2.1.2 (2018-07-30)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.1.1...2.1.2)

 - Fix tag of first list.


2.1.1 (2018-06-28)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.1.0...2.1.1)

 - Fix missing active class for dropdown items


2.1.0 (2018-06-28)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.0.0...2.1.0)

 - Add support for folder pages, displayed as dropdown-header
 - Automatically add dropdown-divider if folderpage not first item.
 - Fix issue with navigations having more than 2 levels.


2.0.0 (2018-01-05)
------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.0.0-beta...2.0.0)

 - Support Metapalettes v2.0


2.0.0-beta1 (2017-10-04)
------------------------

[Full Changelog](https://github.com/contao-bootstrap/navbar/compare/2.0.0-alpha1...2.0.0-beta1)

Implemented enhancements:

 - Added .gitattributes
 - Added CHANGELOG.md

Fixed bugs:

 - Data too long for column 'bootstrap_toggleableSize' [#21](https://github.com/contao-bootstrap/core/issues/21)
 - Support Bootstrap 4 beta changes [#4](https://github.com/contao-bootstrap/navbar/issues/4)
