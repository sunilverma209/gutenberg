import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { TextControl, PanelBody, PanelRow } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

const Edit = (props) => {
    const { attributes, setAttributes } = props;
    const { postID, postTitle, postURL } = attributes;
    const [searchTerm, setSearchTerm] = useState('');
    const [posts, setPosts] = useState([]);

    useEffect(() => {
        if (searchTerm) {
            apiFetch({ path: `/wp/v2/posts?search=${searchTerm}` }).then((posts) => {
                setPosts(posts);
            });
        } else {
            apiFetch({ path: '/wp/v2/posts?per_page=5' }).then((posts) => {
                setPosts(posts);
            });
        }
    }, [searchTerm]);

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Post Selection', 'dmg')}>
                    <PanelRow>
                        <TextControl
                            label={__('Search Posts', 'dmg')}
                            value={searchTerm}
                            onChange={(term) => setSearchTerm(term)}
                        />
                    </PanelRow>
                    <PanelRow>
                        <ul className='dmg-posts'>
                            {posts.map((post) => (
                                <li key={post.id} className='dmg-posts__list'>
                                    <span
                                        onClick={() => {
                                            setAttributes({
                                                postID: post.id,
                                                postTitle: post.title.rendered,
                                                postURL: post.link,
                                            });
                                        }}
                                    >
                                        {post.title.rendered}
                                    </span>
                                </li>
                            ))}
                        </ul>
                    </PanelRow>
                </PanelBody>
            </InspectorControls>
            <div {...useBlockProps()}>
                <p>{__('Read More: ', 'dmg')}<a href={postURL} className="dmg-read-more">{postTitle}</a></p>
            </div>
        </>
    );
};

export default Edit;
