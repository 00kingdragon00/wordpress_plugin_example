import block_icons from "../icons";
import "./editor.scss";

const { registerBlockType } = wp.blocks;
const { Button, Dashicon } = wp.components;
const { __ } = wp.i18n;
const { MediaUpload, MediaUploadCheck } = wp.editor;
registerBlockType("test/media-upload", {
  title: __("Image Media Upload", "recipe"),
  description: __("Image Media Upload", "recipe"),
  category: "common",
  icon: block_icons.wapuu,
  attributes: {
    img_ID: {
      type: "number",
    },
    img_URL: {
      type: "string",
      source: "attribute",
      attribute: "src",
      selector: "img",
    },
    img_alt: {
      type: "string",
      source: "attribute",
      attribute: "atl",
      selector: "img",
    },
  },
  edit: (props) => {
    const select_img = (img) => {
      props.setAttributes({
        img_ID: img.id,
        img_URL: img.url,
        img_alt: img.alt,
      });
    };

    const remove_img = (img) => {
      props.setAttributes({
        img_ID: null,
        img_URL: null,
        img_alt: null,
      });
    };
    return (
      <div className={props.className}>
        {props.attributes.img_ID ? (
          <div className="image-ctr">
            <img src={props.attributes.img_URL} alt={props.attributes.img_alt} />

            {props.isSelected ? (
              <Button className="btn-remove" onClick={remove_img}>
                <Dashicon icon="no" size="20" />
              </Button>
            ) : null}
          </div>
        ) : (
          <MediaUploadCheck>
            <MediaUpload
              allowedType={["image"]}
              value={props.attributes.img_ID}
              onSelect={select_img}
              render={({ open }) => (
                <Button className="button button-large" onClick={open}>
                  {__("Upload Image", "recipe")}
                </Button>
              )}
            ></MediaUpload>
          </MediaUploadCheck>
        )}
      </div>
    );
  },
  save: (props) => {
    return (
      <div>
        <div className="image-ctr">
          <img src={props.attributes.img_URL} alt={props.attributes.img_alt} />
        </div>
      </div>
    );
  },
});