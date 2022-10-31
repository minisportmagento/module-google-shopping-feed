# What it does

It is a build up over module `run_as_root/ext-magento2-google-shopping-feed`. So it could work when Magento Inventory modules disabled.

You may need to remove dependencies for Magento Invetory in RunAsRoot `module.xml` when you need to have Magento Inventory modules disabled.

### Installation

```bash
cd <magento_root>
composer config repositories.module-google-shopping-feed vcs git@github.com:minisportmagento/module-google-shopping-feed.git
composer require minisportmagento/module-google-shopping-feed
```
