<?php

namespace ZFBook\Cache\Storage\Adapter;

use Zend\Cache\Storage\Adapter\AbstractAdapter;


class BlackHole extends AbstractAdapter
{
    /**
     * GlobIterator used as statement
     *
     * @var GlobIterator|null
     */
    protected $stmtGlob = null;

    /**
     * Matching mode of active statement
     *
     * @var integer|null
     */
    protected $stmtMatch = null;

    /**
     * Last buffered identified of internal method getKeyInfo()
     *
     * @var string|null
     */
    protected $lastInfoId = null;

    /**
     * Buffered result of internal method getKeyInfo()
     *
     * @var array|null
     */
    protected $lastInfo = null;

    /* configuration */

    /**
     * Set options.
     *
     * @param  array|Traversable|FilesystemOptions $options
     * @return Filesystem
     * @see    getOptions()
     */
    public function setOptions($options)
    {
        return parent::setOptions($options);
    }

    /**
     * Get options.
     *
     * @return FilesystemOptions
     * @see setOptions()
     */
    public function getOptions()
    {
        return $this->options;
    }

    /* reading */

    /**
     * Get an item.
     *
     * Options:
     *  - ttl <int> optional
     *    - The time-to-life (Default: ttl of object)
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - ignore_missing_items <boolean> optional
     *    - Throw exception on missing item or return false
     *
     * @param  string $key
     * @param  array  $options
     * @return mixed Data on success and false on failure
     * @throws Exception
     *
     * @triggers getItem.pre(PreEvent)
     * @triggers getItem.post(PostEvent)
     * @triggers getItem.exception(ExceptionEvent)
     */
    public function getItem($key, array $options = array(), & $success = null, & $casToken = null)
    {
        return false;
    }

    /**
     * Get multiple items.
     *
     * Options:
     *  - ttl <int> optional
     *    - The time-to-life (Default: ttl of object)
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *
     * @param  array $keys
     * @param  array $options
     * @return array Associative array of existing keys and values
     * @throws Exception
     *
     * @triggers getItems.pre(PreEvent)
     * @triggers getItems.post(PostEvent)
     * @triggers getItems.exception(ExceptionEvent)
     */
    public function getItems(array $keys, array $options = array())
    {
        return array();
    }

    /**
     * Internal method to get an item.
     *
     * Options:
     *  - ttl <int>
     *    - The time-to-life
     *  - namespace <string>
     *    - The namespace to use
     *  - ignore_missing_items <boolean>
     *    - Throw exception on missing item or return false
     *
     * @param  string $normalizedKey
     * @param  array  $normalizedOptions
     * @return mixed Data on success or false on failure
     * @throws Exception
     */
    protected function internalGetItem(& $normalizedKey, array & $normalizedOptions, & $success = null, & $casToken = null)
    {
    }

    /**
     * Test if an item exists.
     *
     * Options:
     *  - ttl <int> optional
     *    - The time-to-life (Default: ttl of object)
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *
     * @param  string $key
     * @param  array  $options
     * @return boolean
     * @throws Exception
     *
     * @triggers hasItem.pre(PreEvent)
     * @triggers hasItem.post(PostEvent)
     * @triggers hasItem.exception(ExceptionEvent)
     */
    public function hasItem($key, array $options = array())
    {
        return false;
    }

    /**
     * Test multiple items.
     *
     * Options:
     *  - ttl <int> optional
     *    - The time-to-life (Default: ttl of object)
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *
     * @param  array $keys
     * @param  array $options
     * @return array Array of existing keys
     * @throws Exception
     *
     * @triggers hasItems.pre(PreEvent)
     * @triggers hasItems.post(PostEvent)
     * @triggers hasItems.exception(ExceptionEvent)
     */
    public function hasItems(array $keys, array $options = array())
    {
        return false;
    }

    /**
     * Internal method to test if an item exists.
     *
     * Options:
     *  - ttl <int>
     *    - The time-to-life
     *  - namespace <string>
     *    - The namespace to use
     *
     * @param  string $normalizedKey
     * @param  array  $normalizedOptions
     * @return boolean
     * @throws Exception
     */
    protected function internalHasItem(& $normalizedKey, array & $normalizedOptions)
    {
        return false;
    }

    /**
     * Get metadata
     *
     * @param $key
     * @param array $options
     * @return array|bool|mixed|null
     */
    public function getMetadata($key, array $options = array())
    {
        return false;
    }

    /**
     * Get metadatas
     *
     * @param array $keys
     * @param array $options
     * @return array
     */
    public function getMetadatas(array $keys, array $options = array())
    {
        return false;
    }

    /**
     * Get info by key
     *
     * @param string $normalizedKey
     * @param array  $normalizedOptions
     * @return array|bool
     * @throws ItemNotFoundException
     */
    protected function internalGetMetadata(& $normalizedKey, array & $normalizedOptions)
    {
        return false;
    }

    /* writing */

    /**
     * Store an item.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - tags <array> optional
     *    - An array of tags
     *
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $options
     * @return boolean
     * @throws Exception
     *
     * @triggers setItem.pre(PreEvent)
     * @triggers setItem.post(PostEvent)
     * @triggers setItem.exception(ExceptionEvent)
     */
    public function setItem($key, $value, array $options = array())
    {
        return false;
    }

    /**
     * Store multiple items.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - tags <array> optional
     *    - An array of tags
     *
     * @param  array $keyValuePairs
     * @param  array $options
     * @return boolean
     * @throws Exception
     *
     * @triggers setItems.pre(PreEvent)
     * @triggers setItems.post(PostEvent)
     * @triggers setItems.exception(ExceptionEvent)
     */
    public function setItems(array $keyValuePairs, array $options = array())
    {
        return false;
    }

    /**
     * Add an item.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - tags <array> optional
     *    - An array of tags
     *
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $options
     * @return boolean
     * @throws Exception
     *
     * @triggers addItem.pre(PreEvent)
     * @triggers addItem.post(PostEvent)
     * @triggers addItem.exception(ExceptionEvent)
     */
    public function addItem($key, $value, array $options = array())
    {
        return false;
    }

    /**
     * Add multiple items.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - tags <array> optional
     *    - An array of tags
     *
     * @param  array $keyValuePairs
     * @param  array $options
     * @return boolean
     * @throws Exception
     *
     * @triggers addItems.pre(PreEvent)
     * @triggers addItems.post(PostEvent)
     * @triggers addItems.exception(ExceptionEvent)
     */
    public function addItems(array $keyValuePairs, array $options = array())
    {
        return false;
    }

    /**
     * Replace an existing item.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - tags <array> optional
     *    - An array of tags
     *
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $options
     * @return boolean
     * @throws Exception
     *
     * @triggers replaceItem.pre(PreEvent)
     * @triggers replaceItem.post(PostEvent)
     * @triggers replaceItem.exception(ExceptionEvent)
     */
    public function replaceItem($key, $value, array $options = array())
    {
        return false;
    }

    /**
     * Replace multiple existing items.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - tags <array> optional
     *    - An array of tags
     *
     * @param  array $keyValuePairs
     * @param  array $options
     * @return boolean
     * @throws Exception
     *
     * @triggers replaceItems.pre(PreEvent)
     * @triggers replaceItems.post(PostEvent)
     * @triggers replaceItems.exception(ExceptionEvent)
     */
    public function replaceItems(array $keyValuePairs, array $options = array())
    {
        return false;
    }

    /**
     * Internal method to store an item.
     *
     * Options:
     *  - namespace <string>
     *    - The namespace to use
     *  - tags <array>
     *    - An array of tags
     *
     * @param  string $normalizedKey
     * @param  mixed  $value
     * @param  array  $normalizedOptions
     * @return boolean
     * @throws Exception
     */
    protected function internalSetItem(& $normalizedKey, & $value, array & $normalizedOptions)
    {
        return false;
    }

    /**
     * Set an item only if token matches
     *
     * It uses the token received from getItem() to check if the item has
     * changed before overwriting it.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - tags <array> optional
     *    - An array of tags
     *
     * @param  mixed  $token
     * @param  string $key
     * @param  mixed  $value
     * @param  array  $options
     * @return boolean
     * @throws Exception
     * @see    getItem()
     * @see    setItem()
     */
    public function checkAndSetItem($token, $key, $value, array $options = array())
    {
        return false;
    }

    /**
     * Internal method to set an item only if token matches
     *
     * Options:
     *  - ttl <float>
     *    - The time-to-life
     *  - namespace <string>
     *    - The namespace to use
     *  - tags <array>
     *    - An array of tags
     *
     * @param  mixed  $token
     * @param  string $normalizedKey
     * @param  mixed  $value
     * @param  array  $normalizedOptions
     * @return boolean
     * @throws Exception
     * @see    getItem()
     * @see    setItem()
     */
    protected function internalCheckAndSetItem(& $token, & $normalizedKey, & $value, array & $normalizedOptions)
    {
        return false;
    }

    /**
     * Reset lifetime of an item
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *
     * @param  string $key
     * @param  array  $options
     * @return boolean
     * @throws Exception
     *
     * @triggers touchItem.pre(PreEvent)
     * @triggers touchItem.post(PostEvent)
     * @triggers touchItem.exception(ExceptionEvent)
     */
    public function touchItem($key, array $options = array())
    {
        return false;
    }

    /**
     * Reset lifetime of multiple items.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *
     * @param  array $keys
     * @param  array $options
     * @return boolean
     * @throws Exception
     *
     * @triggers touchItems.pre(PreEvent)
     * @triggers touchItems.post(PostEvent)
     * @triggers touchItems.exception(ExceptionEvent)
     */
    public function touchItems(array $keys, array $options = array())
    {
        return false;
    }

    /**
     * Internal method to reset lifetime of an item
     *
     * Options:
     *  - ttl <float>
     *    - The time-to-life
     *  - namespace <string>
     *    - The namespace to use
     *
     * @param  string $key
     * @param  array  $options
     * @return boolean
     * @throws Exception
     */
    protected function internalTouchItem(& $normalizedKey, array & $normalizedOptions)
    {
        return false;
    }

    /**
     * Remove an item.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - ignore_missing_items <boolean> optional
     *    - Throw exception on missing item
     *
     * @param  string $key
     * @param  array  $options
     * @return boolean
     * @throws Exception
     *
     * @triggers removeItem.pre(PreEvent)
     * @triggers removeItem.post(PostEvent)
     * @triggers removeItem.exception(ExceptionEvent)
     */
    public function removeItem($key, array $options = array())
    {
        return false;
    }

    /**
     * Remove multiple items.
     *
     * Options:
     *  - namespace <string> optional
     *    - The namespace to use (Default: namespace of object)
     *  - ignore_missing_items <boolean> optional
     *    - Throw exception on missing item
     *
     * @param  array $keys
     * @param  array $options
     * @return boolean
     * @throws Exception
     *
     * @triggers removeItems.pre(PreEvent)
     * @triggers removeItems.post(PostEvent)
     * @triggers removeItems.exception(ExceptionEvent)
     */
    public function removeItems(array $keys, array $options = array())
    {
        return false;
    }

    /**
     * Internal method to remove an item.
     *
     * Options:
     *  - namespace <string>
     *    - The namespace to use
     *  - ignore_missing_items <boolean>
     *    - Throw exception on missing item
     *
     * @param  string $normalizedKey
     * @param  array  $normalizedOptions
     * @return boolean
     * @throws Exception
     */
    protected function internalRemoveItem(& $normalizedKey, array & $normalizedOptions)
    {
        return false;
    }

    /* non-blocking */

    /**
     * internal method to find items.
     *
     * Options:
     *  - ttl <float>
     *    - The time-to-live
     *  - namespace <string>
     *    - The namespace to use
     *
     * @param  int   $normalizedMode Matching mode (Value of Adapter::MATCH_*)
     * @param  array $normalizedOptions
     * @return boolean
     * @throws Exception
     * @see    fetch()
     * @see    fetchAll()
     */
    protected function internalFind(& $normalizedMode, array & $normalizedOptions)
    {
        return false;
    }

    /**
     * Internal method to fetch the next item from result set
     *
     * @return array|boolean The next item or false
     * @throws Exception
     */
    protected function internalFetch()
    {
        return false;
    }

    /* cleaning */

    /**
     * Internal method to clear items off all namespaces.
     *
     * @param  int   $normalizedMode Matching mode (Value of Adapter::MATCH_*)
     * @param  array $normalizedOptions
     * @return boolean
     * @throws Exception
     * @see    clearByNamespace()
     */
    protected function internalClear(& $normalizedMode, array & $normalizedOptions)
    {
        return false;
    }

    /**
     * Clear items by namespace.
     *
     * Options:
     *  - ttl <float>
     *    - The time-to-life
     *  - namespace <string>
     *    - The namespace to use
     *  - tags <array>
     *    - Tags to search for used with matching modes of Adapter::MATCH_TAGS_*
     *
     * @param  int   $normalizedMode Matching mode (Value of Adapter::MATCH_*)
     * @param  array $normalizedOptions
     * @return boolean
     * @throws Exception
     * @see    clear()
     */
    protected function internalClearByNamespace(& $normalizedMode, array & $normalizedOptions)
    {
        return false;
    }

    /**
     * Internal method to optimize adapter storage.
     *
     * Options:
     *  - namespace <string>
     *    - The namespace to use
     *
     * @param  array $normalizedOptions
     * @return boolean
     * @throws Exception
     */
    protected function internalOptimize(array & $normalizedOptions)
    {
        return false;
    }

    /* status */

    /**
     * Internal method to get capabilities of this adapter
     *
     * @return Capabilities
     */
    protected function internalGetCapabilities()
    {
        return false;
    }

    /**
     * Internal method to get storage capacity.
     *
     * @param  array $normalizedOptions
     * @return array|boolean Capacity as array or false on failure
     * @throws Exception
     */
    protected function internalGetCapacity(array & $normalizedOptions)
    {
        return false;
    }

    /* internal */

    /**
     * Fetch by glob
     *
     * @return array|bool
     */
    protected function fetchByGlob()
    {
        return false;
    }

    /**
     * Clear by prefix
     *
     * @param $prefix
     * @param $mode
     * @param array $opts
     * @return bool
     * @throws RuntimeException
     */
    protected function clearByPrefix($prefix, $mode, array &$opts)
    {
        return false;
    }

    /**
     * Removes directories recursive by namespace
     *
     * @param  string $dir    Directory to delete
     * @param  string $prefix Namespace + Separator
     * @return bool
     */
    protected function rmDir($dir, $prefix)
    {
        return false;
    }

    /**
     * Get an array of information about the cache key.
     * NOTE: returns false if cache doesn't hit.
     *
     * @param  string $key
     * @param  string $ns
     * @return array|boolean
     */
    protected function getKeyInfo($key, $ns)
    {
        return false;
    }

    /**
     * Get file spec of the given key and namespace
     *
     * @param  string $key
     * @param  string $ns
     * @return string
     */
    protected function getFileSpec($key, $ns)
    {
        return false;
    }

    /**
     * Read info file
     *
     * @param string $file
     * @return array|boolean The info array or false if file wasn't found
     * @throws Exception\RuntimeException
     */
    protected function readInfoFile($file)
    {
        return false;
    }

    /**
     * Read a complete file
     *
     * @param  string $file File complete path
     * @return string
     * @throws Exception\RuntimeException
     */
    protected function getFileContent($file)
    {
        return false;
    }

    /**
     * Write content to a file
     *
     * @param  string $file  File complete path
     * @param  string $data  Data to write
     * @return bool
     * @throws Exception\RuntimeException
     */
    protected function putFileContent($file, $data)
    {
        return false;
    }

    /**
     * Unlink a file
     *
     * @param string $file
     * @return void
     * @throw RuntimeException
     */
    protected function unlink($file)
    {
        return false;
    }
}
