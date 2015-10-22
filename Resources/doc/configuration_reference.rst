Full default configuration
==========================

.. code-block:: yaml

    # Default configuration for extension with alias: "exsyst_api"

    exsyst_api:
        serialization:
            enabled: true
            default_format: json
        routing:
            enabled: false
        versioning:
            enabled: false
            attributeName: apiVersion
            default: null
            versions: {  }
            resolvers: { query: true, constraint: true }
        parameter:
            validation: { enabled: false, attributeName: validationErrors }
