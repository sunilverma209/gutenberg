import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

const Save = (props) => {
    const { attributes } = props;
    const { postTitle, postURL } = attributes;

    return (
        <p {...useBlockProps.save()}>
            {__('Read More: ', 'dmg')}
            <a href={postURL} className="dmg-read-more">{postTitle}</a>
        </p>
    );
};

export default Save;
