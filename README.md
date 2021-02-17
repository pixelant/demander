```typo3_typoscript
  properties {
      property_name {
         table = tx_tablename_domain_model_blah
         field = pid
         operator = <
      }

      property_name2 {
          table = tx_tablename2_domain_model_blah
          field = uid
          operator = in
      }

      property_name3 {
          table = tx_tablename3_domain_model_blah
          field = uid
          operator = =
      }
  }

  demands {
    orderBy = name
    orderDirection = ASC
    property_name.value = 4

    or {
      property_name2.value {
         min = 3
         max = 6
      }

      property_name3.value = 6
      }
  }


  //Demander filtering from Product Manager
          product_type {
            table = tx_pxaproductmanager_domain_model_attributevalue
            field = value
            operator = likeAndCSL
            additionalRestriction {
                tx_pxaproductmanager_domain_model_attributevalue-attribute {
                    operator = =
                    value = 5
                }
            }
        }

        product_gun_type {
            table = tx_pxaproductmanager_domain_model_attributevalue
            field = value
            operator = likeOrCSL
            additionalRestriction {
                tx_pxaproductmanager_domain_model_attributevalue-attribute {
                    operator = =
                    value = 4
                }
            }
        }
```
