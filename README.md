<h1 align="center">
    <a href="http://bitbag.shop" target="_blank">
        <img src="https://raw.githubusercontent.com/bitbager/BitBagCommerceAssets/master/SyliusInvoicingPlugin.png" />
    </a>
    <br />
    <a href="https://packagist.org/packages/bitbag/invoicing-plugin" title="License" target="_blank">
        <img src="https://img.shields.io/packagist/l/bitbag/invoicing-plugin.svg" />
    </a>
    <a href="https://packagist.org/packages/bitbag/invoicing-plugin" title="Version" target="_blank">
        <img src="https://img.shields.io/packagist/v/bitbag/invoicing-plugin.svg" />
    </a>
    <a href="http://travis-ci.org/BitBagCommerce/SyliusInvoicingPlugin" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/BitBagCommerce/SyliusInvoicingPlugin/master.svg" />
    </a>
    <a href="https://scrutinizer-ci.com/g/BitBagCommerce/SyliusInvoicingPlugin/" title="Scrutinizer" target="_blank">
        <img src="https://img.shields.io/scrutinizer/g/BitBagCommerce/SyliusInvoicingPlugin.svg" />
    </a>
    <a href="https://packagist.org/packages/bitbag/invoicing-plugin" title="Total Downloads" target="_blank">
        <img src="https://poser.pugx.org/bitbag/invoicing-plugin/downloads" />
    </a>
</h1>


## Overview

This plugin enables generating invoices in Sylius platform application. It adds a VAT number field for the billing
address during the checkout and allows to download the invoice in the admin panel view. 

## Installation
```bash
$ composer require bitbag/invoicing-plugin
```
    
Add plugin dependencies to your AppKernel.php file:
```php
public function registerBundles()
{
    return array_merge(parent::registerBundles(), [
        ...
        
        new \Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
        new \BitBag\SyliusInvoicingPlugin\BitBagSyliusInvoicingPlugin(),
    ]);
}
```

### Note

This plugin uses wkhtmltopdf under the hood wrapped into [KnpSnappyBundle](https://github.com/KnpLabs/KnpSnappyBundle). 
It requires you to install the wkthmltopdf binary. Read more [in the KnpSnappyBundle docs](https://github.com/KnpLabs/KnpSnappyBundle)
and on [Wkhtmltopdf website](https://wkhtmltopdf.org/).

### Available services you can [decorate](https://symfony.com/doc/current/service_container/service_decoration.html).

```bash
  bitbag_sylius_invoicing_plugin.controller.action.download_order_invoice                      BitBag\SyliusInvoicingPlugin\Controller\Action\DownloadOrderInvoice                                       
  bitbag_sylius_invoicing_plugin.controller.company_data                                       Sylius\Bundle\ResourceBundle\Controller\ResourceController                                                
  bitbag_sylius_invoicing_plugin.controller.invoice                                            Sylius\Bundle\ResourceBundle\Controller\ResourceController                                                
  bitbag_sylius_invoicing_plugin.event_listener.company_data                                   BitBag\SyliusInvoicingPlugin\Menu\CompanyDataMenuBuilder                                                  
  bitbag_sylius_invoicing_plugin.event_listener.order_show                                     BitBag\SyliusInvoicingPlugin\Menu\DownloadInvoiceMenuBuilder                                              
  bitbag_sylius_invoicing_plugin.factory.company_data                                          Sylius\Component\Resource\Factory\Factory                                                                 
  bitbag_sylius_invoicing_plugin.factory.invoice                                               Sylius\Component\Resource\Factory\Factory                                                                 
  bitbag_sylius_invoicing_plugin.file_generator.invoice_file                                   BitBag\SyliusInvoicingPlugin\FileGenerator\InvoicePdfFileGenerator                                        
  bitbag_sylius_invoicing_plugin.form.extension.address                                        BitBag\SyliusInvoicingPlugin\Form\Extension\AddressTypeExtension                                          
  bitbag_sylius_invoicing_plugin.form.type.company_data                                        BitBag\SyliusInvoicingPlugin\Form\Type\CompanyDataType                                                    
  bitbag_sylius_invoicing_plugin.form.type.invoice                                             BitBag\SyliusInvoicingPlugin\Form\Type\InvoiceType                                                        
  bitbag_sylius_invoicing_plugin.manager.company_data                                          alias for "doctrine.orm.default_entity_manager"                                                           
  bitbag_sylius_invoicing_plugin.manager.invoice                                               alias for "doctrine.orm.default_entity_manager"                                                           
  bitbag_sylius_invoicing_plugin.repository.company_data                                       BitBag\SyliusInvoicingPlugin\Repository\CompanyDataRepository                                             
  bitbag_sylius_invoicing_plugin.repository.invoice                                            BitBag\SyliusInvoicingPlugin\Repository\InvoiceRepository                                                 
  bitbag_sylius_invoicing_plugin.resolver.company_data                                         BitBag\SyliusInvoicingPlugin\Resolver\CompanyDataResolver                                                 
  bitbag_sylius_invoicing_plugin.resolver.invoice_file                                         BitBag\SyliusInvoicingPlugin\Resolver\InvoiceFileResolver                                                 
  bitbag_sylius_invoicing_plugin.validator.vat_number                                          BitBag\SyliusInvoicingPlugin\Validator\Constraints\VatNumberValidator
```

### Default parameters

```yml
parameters:
    wkhtmltopdf_binary_path: /usr/local/bin/wkhtmltopdf
    invoices_root_dir: "%kernel.root_dir%/../invoices"
```

Import required config in your `app/config/config.yml` file:

```yaml
# app/config/config.yml

imports:
    ...
    
    - { resource: "@BitBagSyliusInvoicingPlugin/Resources/config/config.yml" }
```

Import routing in your `app/config/routing.yml` file:

```yaml

# app/config/routing.yml
...

bitbag_sylius_cms_plugin:
    resource: '@BitBagSyliusInvoicingPlugin/Resources/config/routing.yml'
```

Finish the installation by updating/migrating the database schema:
```
$ bin/console doctrine:schema:update --force
```

## Usage

In your admin panel, add the company data. So far, only single company data is supported. 

To see what templates you need to override in order to enable this plugin on your storefront, browse Twig files from 
`/tests/Application/app/Resources/SyliusShopBundle` path of this plugin. 

To override the invoice template, override the `invoice.html.twig` file of this plugin, which you should 
do in `app/Resources/BitBagSyliusInvoicingPlugin/views/invoice.html.twig` file of your local project or in the
theme path, in case you are using multiple themes. 

## Testing
```bash
$ composer install
$ cd tests/Application
$ yarn install
$ yarn run gulp
$ bin/console assets:install web -e test
$ bin/console doctrine:schema:create -e test
$ bin/console server:run 127.0.0.1:8080 -d web -e test
$ open http://localhost:8080
$ bin/behat
$ bin/phpspec run
```

## Contribution

Learn more about our contribution workflow on http://docs.sylius.org/en/latest/contributing/.

## Support

Want us to help you with this plugin or any Sylius project? Write us an email on mikolaj.krol@bitbag.pl :computer:
